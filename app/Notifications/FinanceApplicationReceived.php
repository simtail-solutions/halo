<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Applicant; 

class FinanceApplicationReceived extends Notification /*implements ShouldQueue*/
{
    use Queueable;

     /**
     * 
     * The new application
     * 
     * @var Application
     * 
     */

    public $application;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('Thank you for submitting your application with Halo Finance. We will be in touch with you shortly to discuss your loan application to complete your submission.')
                    ->line('We will require the below documents:')
                    ->line('- Current Drivers License (Passport if license not available)')
                    ->line('- Medicare card')
                    ->line('- 2 most recent payslips')
                    ->line('Please note blurry copies will not be accepted.')
                    ->line('All docuemnts can be submitted by clicking the link below to email.  You can also text clear copies to 0421 431 885 if you prefer.')
                    ->action('Email documents', config('mail.from.address'))
                    ->line('We will continue this application once the above information is received.')
                    ->line('Our Privacy Policy is availabe on our website.');
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
            // 'applicant' => $this->applicant
            'application' => $this->application
        ];
    }
}
