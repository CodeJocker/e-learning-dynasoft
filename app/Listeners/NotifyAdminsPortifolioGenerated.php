<?php

namespace App\Listeners;

use App\Events\PortifolioGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminsPortifolioGenerated
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
    public function handle(PortifolioGenerated $event): void
    {
        //
    }
}
