<?php

namespace App\Listeners;

use App\Events\QuizStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JoinRealtimeQuizRoom
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(QuizStarted $event): void
    {
        //
    }
}
