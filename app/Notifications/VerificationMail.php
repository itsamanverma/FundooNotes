<?php
/**
 * Notification for sending the verification mail to the user queued email
 * so happens on different process 
 * run "    " to clear queue
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerificationMail extends Notification implements shouldQueue
{
    use Queueable;

    public $email;
    public $token; 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $email,string $token)
    {
       $this->email = $email;
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
        $url = 'verifyemail/$this->token';
        // var_dump($url);
        // print_f($url);
        return (new MailMessage)
                    ->line('Welcome to FundooNotes')
                    ->line('Please Verify your email to get started with us')
                    ->action('Verification of Email', url($url))
                    ->line('Thank you for Registeration!');
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
            //
        ];
    }
}
