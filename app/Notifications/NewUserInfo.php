<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserInfo extends Notification
{
    use Queueable;
    public $email_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email_data)
    {
        $this->email_data = $email_data;
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
        $user_type = $this->email_data['user_type'];
        return (new MailMessage)
                        ->greeting('Hello Admin')
                        ->subject('New '.$user_type.' registration')
                        ->line('The '.$user_type.' details is below : ')
                        ->line('The '.$user_type.' name is  : '.$this->email_data['first_name'].' '.$this->email_data['last_name'])
                        ->line($user_type.'  email id is : '.$this->email_data['email'])
                        ->line($user_type.' id is : '.$this->email_data['id_no'])
                        ->line('Please check and review the '.$user_type.' details')
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
