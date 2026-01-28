<?php

namespace App\Notifications;

use App\NotificationPriority;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeUserNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Choose delivery channels
     */
    public function via($notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * EMAIL CHANNEL
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to the Platform')
            ->greeting('Hello '.$notifiable->name)
            ->line('Your account was created successfully.')
            ->line('We’re glad to have you on board.');
    }

    /**
     * DATABASE CHANNEL
     */
    public function toArray($notifiable): array
    {
        return [
            'type'    => 'user_registered',
            'title'   => 'Welcome',
            'message' => 'Your account was created successfully.',
        ];
    }

    /**
     * BROADCAST EVENT NAME
     */
    public function broadcastType(): string
    {
        return 'notification.user_registered';
    }

    public function priority(): NotificationPriority
    {
        return NotificationPriority::NORMAL;
    }

}
