<?php

namespace App\Notifications;

use App\Models\Souscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyNewSouscription extends Notification
{
    use Queueable;
    public $souscription;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Souscription $souscription)
    {
        $this->souscription = $souscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->bcc(config('mail.cc'))->subject('Confirmation Souscription - '.$this->souscription->programme->nom)->markdown('emails.notifications.new-souscription',['souscription'=>$this->souscription]);
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
            //
        ];
    }
}
