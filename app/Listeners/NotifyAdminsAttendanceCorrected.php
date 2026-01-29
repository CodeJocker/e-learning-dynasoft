<?php

namespace App\Listeners;

use App\Events\AttendanceCorrected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminsAttendanceCorrected
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
    public function handle(AttendanceCorrected $event): void
    {
        //
    }
}
