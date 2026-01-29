<?php

namespace App\Listeners;

use App\Events\QuizLeaderboardUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastLeaderboardUpdates
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
    public function handle(QuizLeaderboardUpdated $event): void
    {
        //
    }
}
