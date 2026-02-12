<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\User;
use App\Notifications\AdminUserRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminsOfNewUser implements ShouldQueue
{
    public function handle(UserRegistered $event): void
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new AdminUserRegisteredNotification()
            );
        }
    }
}

