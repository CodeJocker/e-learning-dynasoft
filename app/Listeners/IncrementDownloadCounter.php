<?php

namespace App\Listeners;

use App\Events\MaterialDownloaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementDownloadCounter
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
    public function handle(MaterialDownloaded $event): void
    {
        //
    }
}
