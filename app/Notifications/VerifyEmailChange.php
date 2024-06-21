<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailChange extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
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
            ->line('You requested to change your email address. Please verify your new email address.')
            ->action('Verify Email', url('/email/verify-new-email/'.$this->user->email_verification_token))
            ->line('If you did not request this change, please ignore this email.');
    }
}
