<?php

namespace App\Services;

use App\Events\GenericEvent;
use Illuminate\Support\Facades\Log;

class GenericEventDispatcher
{
    /**
     * Dispatch a generic event.
     *
     * @param string $eventName
     * @param array $payload
     * @param string|null $channel
     * @return void
     */
    public function dispatch(string $eventName, array $payload = [], ?string $channel = null): void
    {
        $channel = $channel ?? 'system-events';

        Log::info("Dispatching Generic Event: {$eventName}", ['payload' => $payload, 'channel' => $channel]);

        event(new GenericEvent($eventName, $payload, $channel));
    }
}
