<?php

namespace App\Notifications;

use App\Models\Classes;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentSuccessMail extends Notification
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
        if (Auth::user()->special_course_id === null) {
            $class_details = Classes::where('id',Auth::user()->class)->first();
            $late_fine = $class_details->amount - $this->email_data->amount;
            if ($class_details->monthly_fees === $this->email_data->amount) {
                $late_fine = 'No';
            }else{
                $late_fine = 'Rs. '.$class_details->amount - $this->email_data->amount;
            }
        }else{
            $late_fine = 'No';
        }
        if ($this->email_data->fees_type === 'monthly_fees') {
            $payment_type = 'Monthly Fees for ' . date('F', strtotime($this->email_data->payment_month));
        }else{
            $payment_type = 'Admission Fees';
        }
       return (new MailMessage)
                    ->greeting('Hello '.Auth::user()->first_name.' '.Auth::user()->last_name)
                    ->subject('Successful Payment :)')
                    ->line('Congratulation Your payment is successful.')
                    ->line('Your payment details is below: ')
                    ->line('Payment type: '.$payment_type)
                    ->line('Amount: '.'Rs. '.$this->email_data->amount)
                    ->line('Late Fine: '.$late_fine)
                    ->line('Payment method: '.$this->email_data->payment_method)
                    ->line('Transaction Id: '.$this->email_data->invoice_no)
                    ->line('Payment date: '.date('d-m-Y', strtotime($this->email_data->created_at)).' '. date('h:i A',strtotime(getAsiaTime24($this->email_data->created_at))))
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
