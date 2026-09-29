<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Notifications\ContactReceived;
use App\Services\MetaConversionsService;
use App\Support\MarketingConsent;
use App\Support\SiteData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Show the contact page (Inertia view).
     */
    public function view()
    {
        return Inertia::render('ContactView', [
            'services' => SiteData::services(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MetaConversionsService $meta): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'source' => ['nullable', 'string', 'max:50'],
            'preferred_date' => ['nullable', 'string', 'max:50'],
            'preferred_time' => ['nullable', 'string', 'max:50'],
            'contact_method' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'], // honeypot
            // Meta Pixel / CAPI deduplication key, generated in the browser.
            'event_id' => ['nullable', 'uuid'],
            'event_source_url' => ['nullable', 'url', 'max:2048'],
            'marketing_consent' => ['nullable', 'boolean'],
        ]);

        // Silently drop bots that filled the honeypot field.
        if (! empty($data['website'] ?? null)) {
            return response()->json(['ok' => true], 200);
        }

        $contact = Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'company' => $data['company'] ?? null,
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'source' => $data['source'] ?? 'website-contact-form',
            'preferred_date' => $data['preferred_date'] ?? null,
            'preferred_time' => $data['preferred_time'] ?? null,
            'contact_method' => $data['contact_method'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        try {
            $contact->notify(new ContactReceived($contact));
        } catch (\Throwable $e) {
            $this->logSafely('error', 'Contact notification failed: '.$e->getMessage(), [
                'contact_id' => $contact->id,
                'exception' => $e,
            ]);
        }

        // The enquiry is saved and accepted at this point - only now is it a Lead.
        $this->trackLead($request, $meta, $contact, $data['event_id'] ?? null, $data['event_source_url'] ?? null);

        return response()->json(['ok' => true, 'id' => $contact->id], 201);
    }

    /**
     * Send the server-side Lead event. Wrapped so that no Meta problem can ever
     * surface as a failed contact form submission.
     */
    protected function trackLead(
        Request $request,
        MetaConversionsService $meta,
        Contact $contact,
        ?string $eventId,
        ?string $eventSourceUrl,
    ): void {
        try {
            if ($eventId === null) {
                return;
            }

            if (! MarketingConsent::granted($request)) {
                $this->logSafely('debug', 'Meta CAPI: Lead not sent, no marketing consent.', [
                    'contact_id' => $contact->id,
                ]);

                return;
            }

            // Guard against a repeated submission re-sending the same conversion.
            if (! Cache::add($this->dedupeKey('Lead', $eventId), true, now()->addHours(6))) {
                $this->logSafely('debug', 'Meta CAPI: duplicate Lead suppressed.', ['event_id' => $eventId]);

                return;
            }

            $meta->send(
                eventName: 'Lead',
                eventId: $eventId,
                eventSourceUrl: $eventSourceUrl ?: ($request->headers->get('referer') ?: url('/contact')),
                userData: [
                    'email' => $contact->email,
                    'phone' => $contact->phone,
                    ...$meta->contextFromRequest($request),
                ],
                customData: array_filter([
                    'content_name' => $contact->subject,
                    'content_category' => $contact->source,
                ]),
            );
        } catch (\Throwable $e) {
            $this->logSafely('error', 'Meta CAPI: Lead tracking failed.', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function dedupeKey(string $eventName, string $eventId): string
    {
        return "meta:event:{$eventName}:{$eventId}";
    }

    /**
     * Logging should never turn a successfully saved contact into a failed form.
     *
     * @param  array<string, mixed>  $context
     */
    protected function logSafely(string $level, string $message, array $context = []): void
    {
        try {
            Log::log($level, $message, $context);
        } catch (\Throwable) {
            //
        }
    }
}
