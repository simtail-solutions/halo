<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\User;

class BrochureSent extends Notification implements ShouldQueue
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
    public function __construct(Application $application)
    {
        $this->application = $application;
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
        return (new MailMessage)
                    ->line('A Pretty Penny Finance Brochure has been sent to your client:')
                    ->line('**' . $applicantFirstName . ' ' . $applicantLastName . '**')
                    ->line('We will notify you when they proceed with their application. In the meantime you can login 
                            to track the progress of all your client applications.')
                    ->action('View Applications', route('applications.index'));
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
