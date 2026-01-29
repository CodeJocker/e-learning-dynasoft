<?php

namespace App\Listeners;

use App\Events\AssignmentGraded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyStudentsAssignmentGraded
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
    public function handle(AssignmentGraded $event): void
    {
        //
    }
}
