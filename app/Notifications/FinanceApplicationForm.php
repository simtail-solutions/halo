<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;

class FinanceApplicationForm extends Notification implements ShouldQueue
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
    public function __construct(Application $application, Applicant $applicant)
    {
        $this->application = $application;
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
        $applicantFirstName = $this->application->applicant->firstname;
        $referrer = $this->application->user->businessName;
        $applyLink = $this->application->api_token;

        return (new MailMessage)
                    ->greeting('Hello ' . $applicantFirstName)
                    ->line('We are delighted ' .  $referrer . ' has referred you to Halo Finance.')
                    ->line('This application should only take a few minutes and will not impact your credit score. 
                            Please ensure the application is completed in full and truthfully.')
                    ->line('Halo makes borrowing 
                    more rewarding with flexible loans tailored to your budget helping borrowers get ahead in 
                    life and achieve more with their money. It\'s fairer finance that works for everyone.')
                    ->action('Apply Here', route('applications.edit', $applyLink) )
                    ->line('We will be in touch shortly to discuss our loan options and provide your quote.')
                    ->line('We will require a few documents to confirm your income and ID:')
                    ->line('- Medicare Card and Drivers Licence (Passport if licence not available')
                    ->line('- Two (2) most recent payslips')
                    ->line('***Please note - blurry copies will not be accepted***.');
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
            'application' => $this->application
        ];
    }
}
