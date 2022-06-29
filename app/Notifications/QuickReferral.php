<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;

class QuickReferral extends Notification /*implements ShouldQueue*/
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
        $applicantFirstName = $this->applicant->firstname;
        $applicantLastName = $this->applicant->lastname;
        $referrer = $this->application->user->businessName;
        $appLink = $this->application->api_token;

        return (new MailMessage)
                    ->subject($referrer . ' has sent through a referral')
                    ->line('A quick referral for finance has been submitted.')
                    ->line('Applicant - ' . $applicantFirstName . ' ' . $applicantLastName)
                    ->action('View Referral', route('application.show', $appLink) );
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
