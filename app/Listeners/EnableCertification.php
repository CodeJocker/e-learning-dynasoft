<?php

namespace App\Listeners;

use App\Events\PortifolioApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnableCertification
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
    public function handle(PortifolioApproved $event): void
    {
        //
    }
}
