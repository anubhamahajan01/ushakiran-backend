<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Channels\FcmChannel;
use Illuminate\Bus\Queueable;
use App\Channels\Messages\SmsMessage;
use App\Channels\Messages\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Password reset token
     */
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = config('app.url').'/reset-password/'.$this->token;

        return (new MailMessage)
                    ->subject('Reset Password')
                    ->greeting('Hello!')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset password', $link)
                    ->line('If you did not request a password reset, no further action is required.');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            
        ];
    }
}
