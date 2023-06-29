<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;

class BrochureApplicationLink extends Notification implements ShouldQueue
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
            ->subject('Halo Finance Brochure Request')
            ->markdown('mail.brochure.sent', [
                'applicantFirstName' => $applicantFirstName,
                'referrer' => $referrer,
                'downloadLink' => route('brochure.download'),
                'applyLink' => route('applications.edit', $applyLink)
            ]);
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
