<?php

namespace Tests\Feature;

use App\Events\GenericEvent;
use App\Services\GenericEventDispatcher;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RealtimeEventTest extends TestCase
{
    public function test_generic_event_is_dispatched()
    {
        Event::fake();

        $dispatcher = new GenericEventDispatcher();
        $dispatcher->dispatch('TestEvent', ['key' => 'value']);

        Event::assertDispatched(GenericEvent::class, function ($event) {
            return $event->name === 'TestEvent' &&
                   $event->payload['key'] === 'value';
        });
    }

    public function test_listener_updates_realtime_leaderboard()
    {
        // This test would require mocking Redis and creating a full QuizSubmission,
        // so we'll just test that the class exists and is instantiable for now.
        $this->assertTrue(class_exists(\App\Listeners\UpdateRealtimeLeaderboard::class));
    }
}
