<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;

class HaloFinanceBrochureSentToProspectiveClient extends Notification implements ShouldQueue
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
        $applicantLastName = $this->application->applicant->lastname;
        $referrer = $this->application->user->businessName;

        return (new MailMessage)
                ->greeting('Update!')
                ->line(' A Halo Finance brochure be sent to '. $applicantFirstName . ' ' . $applicantLastName . ' at the request of referrer business - '. $referrer);
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
