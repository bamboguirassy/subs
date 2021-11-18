<?php

namespace App\Mail;

use App\Models\Programme;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactParticipants extends Mailable
{
    use Queueable, SerializesModels;
    public $mailObject;
    public $programme;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Programme $programme,$mailObject)
    {
        $this->programme = $programme;
        $this->mailObject = $mailObject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact-participants',['mailObject'=>$this->mailObject])->subject($this->mailObject['objet'].' - '.$this->programme->nom);
    }
}
