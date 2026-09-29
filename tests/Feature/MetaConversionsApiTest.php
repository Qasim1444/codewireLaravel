<?php

namespace Tests\Feature;

use App\Jobs\SendMetaConversionEvent;
use App\Services\MetaConversionsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;

class MetaConversionsApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.meta.pixel_id', '1234567890');
        config()->set('services.meta.capi_access_token', 'test-token');
        config()->set('services.meta.graph_version', 'v26.0');
        config()->set('services.meta.test_event_code', null);
        config()->set('services.meta.queue', false);
        config()->set('services.meta.require_consent', true);
    }

    /**
     * @return array<string, mixed>
     */
    protected function contactPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Ada Lovelace',
            'email' => 'Ada@Example.COM ',
            'phone' => '+92 (308) 793-3900',
            'subject' => 'Web development',
            'message' => 'I would like a quote for a marketing site.',
            'source' => 'website-contact-form',
            'event_id' => '2c3f7b1e-7c4a-4d5b-9c2e-1a2b3c4d5e6f',
            'event_source_url' => 'https://codewiresolutions.com/contact',
            'marketing_consent' => true,
        ], $overrides);
    }

    public function test_it_delivers_a_lead_event_for_a_successful_submission(): void
    {
        Http::fake([
            'graph.facebook.com/*' => Http::response(['events_received' => 1], 200),
        ]);

        $response = $this->postJson('/contact', $this->contactPayload());

        $response->assertCreated()->assertJson(['ok' => true]);
        $this->assertDatabaseHas('contacts', ['email' => 'Ada@Example.COM']);

        Http::assertSent(function (Request $request) {
            $body = $request->data();
            $event = $body['data'][0];

            return $request->url() === 'https://graph.facebook.com/v26.0/1234567890/events'
                && $request->hasHeader('Authorization', 'Bearer test-token')
                && $event['event_name'] === 'Lead'
                && $event['action_source'] === 'website'
                && $event['event_source_url'] === 'https://codewiresolutions.com/contact'
                && is_int($event['event_time'])
                && ! array_key_exists('test_event_code', $body);
        });
    }

    public function test_it_sends_the_browser_event_id_and_hashed_user_data(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1], 200)]);

        $this->postJson('/contact', $this->contactPayload())->assertCreated();

        Http::assertSent(function (Request $request) {
            $event = $request->data()['data'][0];

            return $event['event_id'] === '2c3f7b1e-7c4a-4d5b-9c2e-1a2b3c4d5e6f'
                // Lowercased + trimmed email, digits-only phone, both SHA-256.
                && $event['user_data']['em'] === hash('sha256', 'ada@example.com')
                && $event['user_data']['ph'] === hash('sha256', '923087933900')
                && ! str_contains(json_encode($event), 'ada@example.com');
        });
    }

    public function test_it_rejects_an_event_id_that_is_not_a_uuid(): void
    {
        Http::fake();

        $this->postJson('/contact', $this->contactPayload(['event_id' => 'not-a-uuid']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors('event_id');

        Http::assertNothingSent();
    }

    public function test_it_includes_the_test_event_code_only_when_configured(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1], 200)]);

        config()->set('services.meta.test_event_code', 'TEST12345');

        $this->postJson('/contact', $this->contactPayload())->assertCreated();

        Http::assertSent(function (Request $request) {
            $body = $request->data();

            // Top level, outside the data array.
            return ($body['test_event_code'] ?? null) === 'TEST12345'
                && ! array_key_exists('test_event_code', $body['data'][0]);
        });
    }

    public function test_it_omits_the_test_event_code_when_empty(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1], 200)]);

        config()->set('services.meta.test_event_code', '');

        $this->postJson('/contact', $this->contactPayload())->assertCreated();

        Http::assertSent(fn (Request $request) => ! array_key_exists('test_event_code', $request->data()));
    }

    public function test_missing_credentials_prevent_any_api_request(): void
    {
        Http::fake();

        config()->set('services.meta.capi_access_token', null);

        $this->postJson('/contact', $this->contactPayload())->assertCreated();

        $this->assertDatabaseCount('contacts', 1);
        Http::assertNothingSent();
    }

    public function test_it_respects_a_refused_marketing_consent(): void
    {
        Http::fake();

        $this->postJson('/contact', $this->contactPayload(['marketing_consent' => false]))
            ->assertCreated();

        $this->assertDatabaseCount('contacts', 1);
        Http::assertNothingSent();
    }

    public function test_it_falls_back_to_the_consent_cookie_when_the_form_omits_the_flag(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1], 200)]);

        $payload = $this->contactPayload();
        unset($payload['marketing_consent']);

        // withCredentials() so the test client actually sends cookies on a JSON request.
        $this->withCredentials()
            ->withUnencryptedCookie('cw_consent', json_encode(['necessary' => true, 'marketing' => true]))
            ->postJson('/contact', $payload)
            ->assertCreated();

        Http::assertSentCount(1);
    }

    public function test_tracking_is_skipped_entirely_without_a_consent_signal(): void
    {
        Http::fake();

        $payload = $this->contactPayload();
        unset($payload['marketing_consent']);

        $this->postJson('/contact', $payload)->assertCreated();

        Http::assertNothingSent();
    }

    public function test_a_meta_api_failure_does_not_break_the_contact_form(): void
    {
        Http::fake([
            'graph.facebook.com/*' => Http::response(['error' => ['message' => 'Invalid token']], 400),
        ]);

        $this->postJson('/contact', $this->contactPayload())
            ->assertCreated()
            ->assertJson(['ok' => true]);

        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_a_network_exception_does_not_break_the_contact_form(): void
    {
        Http::fake(fn () => throw new ConnectionException('timed out'));

        $this->postJson('/contact', $this->contactPayload())
            ->assertCreated()
            ->assertJson(['ok' => true]);

        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_a_repeated_submission_does_not_resend_the_same_conversion(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['events_received' => 1], 200)]);

        $payload = $this->contactPayload();

        $this->postJson('/contact', $payload)->assertCreated();
        $this->postJson('/contact', $payload)->assertCreated();

        $this->assertDatabaseCount('contacts', 2);
        Http::assertSentCount(1);
    }

    public function test_it_queues_the_event_when_queueing_is_enabled(): void
    {
        Http::fake();
        Queue::fake();

        config()->set('services.meta.queue', true);
        config()->set('queue.default', 'database');

        $this->postJson('/contact', $this->contactPayload())->assertCreated();

        Queue::assertPushed(SendMetaConversionEvent::class, function ($job) {
            // Already hashed before it reaches the queue.
            return $job->event['event_name'] === 'Lead'
                && $job->event['user_data']['em'] === hash('sha256', 'ada@example.com');
        });

        Http::assertNothingSent();
    }

    public function test_the_service_builds_an_event_with_the_documented_shape(): void
    {
        $meta = app(MetaConversionsService::class);

        $eventId = (string) Str::uuid();
        $event = $meta->buildEvent(
            'Lead',
            $eventId,
            'https://codewiresolutions.com/contact',
            ['email' => ' TEST@Example.com', 'client_ip_address' => '203.0.113.5', 'fbp' => 'fb.1.1.2'],
            eventTime: 1790664000,
        );

        $this->assertSame([
            'event_name' => 'Lead',
            'event_time' => 1790664000,
            'event_id' => $eventId,
            'action_source' => 'website',
            'event_source_url' => 'https://codewiresolutions.com/contact',
            'user_data' => [
                'em' => hash('sha256', 'test@example.com'),
                'client_ip_address' => '203.0.113.5',
                'fbp' => 'fb.1.1.2',
            ],
        ], $event);
    }

    public function test_the_layout_exposes_the_pixel_id_but_never_the_access_token(): void
    {
        $response = $this->get('/contact');

        $response->assertOk();
        $response->assertSee('1234567890', false);
        $response->assertSee('__loadMetaPixel__', false);
        $response->assertDontSee('test-token', false);
        // The consent-gated build must not ship the unconditional noscript pixel.
        $response->assertDontSee('facebook.com/tr?id=', false);
    }

    public function test_the_layout_omits_the_pixel_entirely_when_no_id_is_configured(): void
    {
        config()->set('services.meta.pixel_id', null);

        $this->get('/contact')
            ->assertOk()
            ->assertDontSee('__loadMetaPixel__', false);
    }
}
