<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMailForPaidUsers extends Notification
{
    use Queueable;
    public $user;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->user = $user;
        $this->password = $password;
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
        $url = route('login');
        $password = 'Welcome'.date('Y',strtotime($this->user['created_at']));
        return (new MailMessage)
                        ->greeting('Hello '.$this->user['first_name'].' '.$this->user['last_name'])
                        ->subject('Approved your account :)')
                        ->line('Your account has been APPROVED')
                        ->line('You can now access leading light web portal.')
                        ->line('Your login credential is: ')
                        ->line('User id : '.$this->user['email'])
                        ->line('Password : '.$this->password)
                        ->action('Login', $url)
                        ->line('Thank you for using our application!');
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
