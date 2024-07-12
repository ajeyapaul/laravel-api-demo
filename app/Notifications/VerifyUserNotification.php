<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyUserNotification extends Notification
{
    use Queueable;

    private $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(__('To finish your registration - site asks you to verify your email'))
            ->action(__('Click here to verify'), route('userVerification', $this->user->verification_token))
            ->line(__('Thank you for using our website'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
