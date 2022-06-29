<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Applicant;

class UpdatedFinanceApplicationReceived extends Notification /* implements ShouldQueue */
{
    use Queueable;

    /**
     * 
     * The new applicant
     * 
     * @var Applicant
     * 
     */

    public $applicant;

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
                    ->line('Your application has been submitted.')
                    ->line('We will be in touch within two (2) business days of receiving 
                    this information with finance options that will work best for your circumstances.')
                    ->line('Please get in contact if you require further information.')
                    ->action('Contact Us', route('contact.index'));
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
            'applicant' => $this->applicant
        ];
    }
}
