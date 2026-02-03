<?php

namespace App\Listeners;

use App\Events\CourseUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyEnrolledStudentsCourseUpdated
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
    public function handle(CourseUpdated $event): void
    {
        //
    }
}
