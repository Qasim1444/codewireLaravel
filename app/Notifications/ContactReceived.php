<?php

namespace App\Notifications;

use App\Mail\ContactReceivedMailable;
use App\Models\Contact;
use App\Support\SiteData;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class ContactReceived extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public Contact $contact)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return Mailable
     */
    public function toMail(mixed $notifiable)
    {
        $site = SiteData::site();
        $adminEmail = $site['contact']['email'] ?? config('mail.from.address');

        return (new ContactReceivedMailable($this->contact))
            ->to($this->contact->email)
            ->cc($adminEmail);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'contact_id' => $this->contact->id,
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
        ];
    }
}
