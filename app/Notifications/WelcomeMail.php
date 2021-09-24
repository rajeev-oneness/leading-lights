<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMail extends Notification
{
    use Queueable;
    public $student;
    public $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student,$password)
    {
        $this->student = $student;
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
        return (new MailMessage)
                    ->greeting('Hello '.$this->student['first_name'].' '.$this->student['last_name'])
                    ->subject('New registration')
                    ->line('Your login credential is: ')
                    ->line('Your email id : '.$this->student['email'])
                    ->line('Your password is :'.$this->password)
                    ->line('To complete your profile click below')
                    ->action('Login', route('user.profile') )
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
