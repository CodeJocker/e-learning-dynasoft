<?php

namespace App\Listeners;

use App\Events\CourseEnrolled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyInstructorStudentEnrolled
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
    public function handle(CourseEnrolled $event): void
    {
        //
    }
}
