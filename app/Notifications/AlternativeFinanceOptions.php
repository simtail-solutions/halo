<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Applicant; 

class AlternativeFinanceOptions extends Notification implements ShouldQueue
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
                ->line('Thank you for applying for finance with Pretty Penny Finance.')
                ->line('Given your current employment status, we will need to explore different options with you.')
                ->line('One of our consultants will be in touch shortly, or you can contact us now to discuss your options.')
                ->action('Contact Pretty Penny Finance', route('contact.index') )
                ->line('We look forward to speaking with you soon.')
                ->line('Include link to Privacy Consent form.');
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
