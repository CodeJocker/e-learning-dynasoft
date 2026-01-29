<?php

namespace App\Listeners;

use App\Events\QuizAnswerSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRealtimeScore
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
    public function handle(QuizAnswerSubmitted $event): void
    {
        //
    }
}
