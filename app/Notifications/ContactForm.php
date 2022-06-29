<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Contact;

class ContactForm extends Notification implements ShouldQueue
{
    use Queueable;

    public $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
        $firstName = $this->contact->firstName;
        $lastName = $this->contact->lastName;
        $businessName = $this->contact->businessName;
        $email = $this->contact->email;
        $phone = $this->contact->phone;
        $message = $this->contact->message;

        return (new MailMessage)
                    ->subject('Contact form from  ' . $businessName)
                    ->line('The contact form has been completed with the following information:')
                    ->line('- **Name:** '. $firstName . ' '. $lastName)
                    ->line('- **Business:** '. $businessName)
                    ->line('- **Email:** '. $email)
                    ->line('- **Phone:** '. $phone)
                    ->line('- **Message:** '. $message)
                    ->action('Reply via email', url('mailto:'.$email));
    
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
            'contact' => $this->contact
        ];
    }
}
