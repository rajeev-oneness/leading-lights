<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMail extends Notification
{
    use Queueable;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $user_type = $this->user['role_id'];
        switch ($user_type) {
            case 1:
                $url = route('admin_login');
                break;
            case 2:
                $url = route('hr_login');
                break;
            case 3:
                $url = route('teacher_login');
                break;
            case 4:
                $url = route('login');
                break;
            case 5:
                $url = route('super_admin_login');
                break;
        }
        return (new MailMessage)
                    ->greeting('Hello '.$this->user['first_name'].' '.$this->user['last_name'])
                    ->subject('Approved your account :)')
                    ->line('Your account has been APPROVED')
                    ->line('You can now access leading light web portal.')
                    ->line('Your login credential is: ')
                    ->line('User id : '.$this->user['email'])
                    ->line('Password : '.$this->user['id_no'])
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
