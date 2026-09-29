<?php

namespace App\Jobs;

use App\Services\MetaConversionsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * Delivers one already-built (and already-hashed) Conversions API event.
 *
 * The event payload is hashed before it is dispatched, so no raw customer data
 * is ever written to the queue backend.
 */
class SendMetaConversionEvent implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    /** @var array<int, int> */
    public array $backoff = [10, 60];

    /**
     * @param  array<string, mixed>  $event
     */
    public function __construct(public array $event) {}

    public function handle(MetaConversionsService $meta): void
    {
        // deliver() swallows and logs its own failures; a Meta outage should not
        // keep the job bouncing around the queue forever.
        $meta->deliver([$this->event]);
    }
}
