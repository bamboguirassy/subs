<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindSubscribedUsers extends Mailable
{
    use Queueable, SerializesModels;
    public $souscription;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($souscription)
    {
        $this->souscription = $souscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.remind-subscribed-users', [
            'souscription' => $this->souscription
        ])
            ->subject("Rappel de programme - " . $this->souscription->programme->nom)
            ->replyTo(config('mail.cc'));
    }
}
