<?php

namespace App\Listeners;
use App\Models\ActivityLog;
use App\Models\User;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogActivityListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function logUserRegistered(UserRegistered $event){
        Log::info('User registered: ', [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'name' => $event->user->name,
        ]);

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

    /**
     * Handle the event.
     */

    public function subscribe($events)
    {
        $events->listen(
            UserRegistered::class,
            [LogActivityListener::class, 'logUserRegistered']
        );
    }
}
