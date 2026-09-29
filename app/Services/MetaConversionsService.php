<?php

namespace App\Services;

use App\Jobs\SendMetaConversionEvent;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Server-side delivery of events to the Meta Conversions API.
 *
 * Browser (Pixel) and server (CAPI) both send the same `event_id` for a given
 * conversion so that Meta deduplicates the pair. Nothing here ever logs the
 * access token or raw customer data - user data leaves this class SHA-256
 * hashed, exactly as Meta expects.
 *
 * @see https://developers.facebook.com/docs/marketing-api/conversions-api
 */
class MetaConversionsService
{
    /** Fields that must be sent in the clear (everything else is hashed). */
    protected const PLAIN_FIELDS = ['client_ip_address', 'client_user_agent', 'fbp', 'fbc'];

    public function pixelId(): ?string
    {
        $id = config('services.meta.pixel_id');

        return is_string($id) && $id !== '' ? $id : null;
    }

    protected function accessToken(): ?string
    {
        $token = config('services.meta.capi_access_token');

        return is_string($token) && $token !== '' ? $token : null;
    }

    public function testEventCode(): ?string
    {
        $code = config('services.meta.test_event_code');

        return is_string($code) && $code !== '' ? $code : null;
    }

    /**
     * Both a pixel id and an access token are required before we may call Meta.
     */
    public function isConfigured(): bool
    {
        return $this->pixelId() !== null && $this->accessToken() !== null;
    }

    public function endpoint(): string
    {
        $version = config('services.meta.graph_version', 'v26.0');

        return sprintf('https://graph.facebook.com/%s/%s/events', $version, $this->pixelId());
    }

    /**
     * Build a single Conversions API event from raw (unhashed) inputs.
     *
     * @param  array<string, mixed>  $userData  Raw values: email, phone, first_name,
     *                                          last_name, client_ip_address,
     *                                          client_user_agent, fbp, fbc.
     * @param  array<string, mixed>  $customData
     * @return array<string, mixed>
     */
    public function buildEvent(
        string $eventName,
        string $eventId,
        string $eventSourceUrl,
        array $userData = [],
        array $customData = [],
        ?int $eventTime = null,
    ): array {
        $event = [
            'event_name' => $eventName,
            'event_time' => $eventTime ?? time(),
            'event_id' => $eventId,
            'action_source' => 'website',
            'event_source_url' => $eventSourceUrl,
            'user_data' => $this->normalizeUserData($userData),
        ];

        if ($customData !== []) {
            $event['custom_data'] = $customData;
        }

        return $event;
    }

    /**
     * Normalise and hash user data according to Meta's matching rules.
     *
     * @param  array<string, mixed>  $userData
     * @return array<string, string>
     */
    public function normalizeUserData(array $userData): array
    {
        $out = [];

        if ($email = $this->normalizeEmail($userData['email'] ?? null)) {
            $out['em'] = $this->hash($email);
        }

        if ($phone = $this->normalizePhone($userData['phone'] ?? null)) {
            $out['ph'] = $this->hash($phone);
        }

        foreach (['first_name' => 'fn', 'last_name' => 'ln'] as $input => $key) {
            $value = $userData[$input] ?? null;

            if (is_string($value) && trim($value) !== '') {
                $out[$key] = $this->hash(mb_strtolower(trim($value)));
            }
        }

        foreach (self::PLAIN_FIELDS as $key) {
            $value = $userData[$key] ?? null;

            if (is_string($value) && $value !== '') {
                $out[$key] = $value;
            }
        }

        return $out;
    }

    protected function normalizeEmail(mixed $email): ?string
    {
        if (! is_string($email)) {
            return null;
        }

        $email = mb_strtolower(trim($email));

        return $email === '' ? null : $email;
    }

    /**
     * Digits only - Meta matches on the country-code-prefixed number.
     */
    protected function normalizePhone(mixed $phone): ?string
    {
        if (! is_string($phone)) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $phone) ?? '';

        return $digits === '' ? null : $digits;
    }

    protected function hash(string $value): string
    {
        return hash('sha256', $value);
    }

    /**
     * Pull the tracking context (IP, UA, click ids) off the current request.
     *
     * @return array<string, string>
     */
    public function contextFromRequest(Request $request): array
    {
        return array_filter([
            'client_ip_address' => $request->ip(),
            'client_user_agent' => $request->userAgent(),
            'fbp' => $request->cookie('_fbp'),
            'fbc' => $request->cookie('_fbc') ?: $this->fbcFromClickId($request),
        ], static fn ($value) => is_string($value) && $value !== '');
    }

    /**
     * Synthesise `fbc` from an `fbclid` query parameter when the cookie has not
     * been written yet (first landing from an ad).
     */
    protected function fbcFromClickId(Request $request): ?string
    {
        $fbclid = $request->query('fbclid');

        if (! is_string($fbclid) || $fbclid === '') {
            return null;
        }

        return sprintf('fb.1.%d.%s', (int) (microtime(true) * 1000), $fbclid);
    }

    /**
     * Build and send (or queue) a single event.
     *
     * @param  array<string, mixed>  $userData
     * @param  array<string, mixed>  $customData
     */
    public function send(
        string $eventName,
        string $eventId,
        string $eventSourceUrl,
        array $userData = [],
        array $customData = [],
        ?int $eventTime = null,
    ): bool {
        if (! $this->isConfigured()) {
            Log::warning('Meta CAPI: event skipped, credentials are not configured.', [
                'event_name' => $eventName,
                'event_id' => $eventId,
            ]);

            return false;
        }

        $event = $this->buildEvent($eventName, $eventId, $eventSourceUrl, $userData, $customData, $eventTime);

        if (config('services.meta.queue', true) && config('queue.default') !== 'sync') {
            // The payload is already hashed, so no raw customer data hits the queue.
            SendMetaConversionEvent::dispatch($event);

            return true;
        }

        return $this->deliver([$event]);
    }

    /**
     * POST events to the Graph API. Never throws - a Meta outage must not be
     * able to take a contact form down with it.
     *
     * @param  array<int, array<string, mixed>>  $events
     */
    public function deliver(array $events): bool
    {
        if (! $this->isConfigured()) {
            Log::warning('Meta CAPI: delivery skipped, credentials are not configured.', [
                'events' => count($events),
            ]);

            return false;
        }

        $payload = ['data' => array_values($events)];

        // test_event_code belongs at the TOP LEVEL, outside the data array.
        if ($code = $this->testEventCode()) {
            $payload['test_event_code'] = $code;
        }

        try {
            /** @var Response $response */
            $response = Http::asJson()
                ->timeout(8)
                ->connectTimeout(4)
                ->retry(2, 200, throw: false)
                ->withToken($this->accessToken())
                ->post($this->endpoint(), $payload);
        } catch (\Throwable $e) {
            Log::error('Meta CAPI: request failed.', [
                'events' => $this->summarise($events),
                'error' => $e->getMessage(),
            ]);

            return false;
        }

        if ($response->failed()) {
            Log::error('Meta CAPI: Meta rejected the request.', [
                'events' => $this->summarise($events),
                'status' => $response->status(),
                'error' => data_get($response->json(), 'error.message', 'unknown error'),
            ]);

            return false;
        }

        Log::info('Meta CAPI: events delivered.', [
            'events' => $this->summarise($events),
            'events_received' => data_get($response->json(), 'events_received'),
            'test_mode' => $this->testEventCode() !== null,
        ]);

        return true;
    }

    /**
     * Log-safe event summary - names and ids only, never user data.
     *
     * @param  array<int, array<string, mixed>>  $events
     * @return array<int, array<string, mixed>>
     */
    protected function summarise(array $events): array
    {
        return array_map(static fn (array $event) => [
            'event_name' => $event['event_name'] ?? null,
            'event_id' => $event['event_id'] ?? null,
        ], array_values($events));
    }
}
