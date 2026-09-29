<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Services\MetaConversionsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Fires the Meta `Schedule` event for a consultation that has actually been
 * confirmed with the client.
 *
 * The consultation form on the site only *requests* a slot (the team confirms
 * it by email afterwards), so submitting that form is a Lead, not a Schedule.
 * Run this once the booking is genuinely confirmed:
 *
 *   php artisan meta:schedule 42
 */
class SendMetaScheduleEvent extends Command
{
    protected $signature = 'meta:schedule {contact : The contacts table id of the confirmed consultation}';

    protected $description = 'Send a confirmed-consultation Schedule event to the Meta Conversions API';

    public function handle(MetaConversionsService $meta): int
    {
        if (! $meta->isConfigured()) {
            $this->error('Meta credentials are not configured (META_PIXEL_ID / META_CAPI_ACCESS_TOKEN).');

            return self::FAILURE;
        }

        $contact = Contact::find($this->argument('contact'));

        if (! $contact) {
            $this->error('No contact found with that id.');

            return self::FAILURE;
        }

        $eventId = (string) Str::uuid();

        // One Schedule per consultation, however many times this is run.
        if (! Cache::add("meta:schedule:contact:{$contact->id}", $eventId, now()->addDays(30))) {
            $this->warn("A Schedule event was already sent for contact #{$contact->id}.");

            return self::SUCCESS;
        }

        $meta->send(
            eventName: 'Schedule',
            eventId: $eventId,
            eventSourceUrl: url('/consultation'),
            userData: array_filter([
                'email' => $contact->email,
                'phone' => $contact->phone,
            ]),
            customData: array_filter([
                'content_name' => $contact->subject,
                'content_category' => 'consultation',
            ]),
        );

        $this->info("Schedule event queued for contact #{$contact->id} (event_id {$eventId}).");

        return self::SUCCESS;
    }
}
