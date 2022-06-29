<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification; 

use App\Models\Application;
use App\Models\Applicant;

class ApplicationUpdates extends Notification
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
        $applicantFirstName = $this->application->applicant->firstname;
        $applicantLastName = $this->application->applicant->lastname;
        $referrer = $this->application->user->businessName;
        $appLink = $this->application->api_token;

        return (new MailMessage)
                    ->subject($applicantFirstName .' '. $applicantLastName . ' has updated their Application')
                    ->line($applicantFirstName .' '. $applicantLastName . ' has updated their Application.')
                    ->line('This applicant was referred by '. $referrer)
                    ->action('View Application', route('application.show', $appLink) );
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
            'application' => $this->application,
            'applicant' => $this->applicant
        ];
    }
}
