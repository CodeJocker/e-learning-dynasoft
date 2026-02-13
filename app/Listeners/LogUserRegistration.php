<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Activitylog\Facades\Activity;

class LogUserRegistration implements ShouldQueue
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
    public function handle(UserRegistered $event): void
    {
        ActivityLog::create([
            'action' => 'user_registered',
            'actor_type' => User::class,
            'actor_id' => $event->user->id,
            'subject_type' => User::class,
            'subject_id' => $event->user->id,
            'meta' => [
                'email' => $event->user->email,
                'registered_at' => now(),
            ],
        ]);
    }
}
