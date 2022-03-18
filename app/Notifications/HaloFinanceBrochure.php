<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;

class HaloFinanceBrochure extends Notification implements ShouldQueue
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
        return ['mail','database'];
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
                    ->line('We are delighted you\'ve requested a Halo Finance Brochure from ' .  $referrer)
                    ->line('***Add link to brochure***')
                    ->line('Halo provide an obligation free quote that doesn\'t affect your credit file.')
                    ->line('if you\'d like to get the ball rolling the applicaiton should only take a few minutes.')
                    ->action('Apply Here', route('applications.edit', $applyLink) )
                    ->line('Please ensure the application is completed in full and truthfully.')
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
