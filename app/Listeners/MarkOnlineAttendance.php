<?php

namespace App\Listeners;

use App\Events\LessonStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkOnlineAttendance
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
    public function handle(LessonStarted $event): void
    {
        //
    }
}
