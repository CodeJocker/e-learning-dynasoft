<?php

namespace App\Notifications;

use App\NotificationPriority;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class AdminUserRegisteredNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type'      => 'admin_user_registered',
            'title'     => 'New User Registered',
            'message'   => 'A new user has joined the platform.',
            'severity'  => 'info',
        ];
    }

    public function broadcastType(): string
    {
        return 'notification.admin.user_registered';
    }

    public function priority(): NotificationPriority
    {
        return NotificationPriority::LOW;
    }

}
