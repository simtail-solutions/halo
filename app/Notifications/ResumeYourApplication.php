<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\Email;

class ResumeYourApplication extends Notification /*implements ShouldQueue*/
{
    use Queueable;

    /**
     * 
     * The new application
     * 
     * @var Application
     * 
     */

    public $application, $applicant;

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
        $applicantFirstName = $this->applicant->firstname;
        $referrer = $this->application->user->businessName;
        $applyLink = $this->application->api_token;

        return (new MailMessage)
                    ->greeting('Hello ' . $applicantFirstName)
                    ->line('We have saved your progress on your Application form.')
                    ->line('Here is a link to complete the form:')
                    ->action('Complete Application', route('applications.edit', $applyLink) )
                    ->line('Please let us know if you have having any difficulties or require further information.')
                    ->line('Just a reminder we will require a few documents to confirm your income and ID:')
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
            'applicant' => $this->applicant,
            'application' => $this->application
        ];
    }
}
