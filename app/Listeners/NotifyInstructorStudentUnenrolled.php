<?php

namespace App\Listeners;

use App\Events\StudentUnenrolled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyInstructorStudentUnenrolled
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
    public function handle(StudentUnenrolled $event): void
    {
        //
    }
}
