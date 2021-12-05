<?php

namespace App\Mail;

use App\Models\SouscriptionTemp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindLeadsToSouscribe extends Mailable
{
    use Queueable, SerializesModels;
    public $souscriptionTemp;
    public $remainDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SouscriptionTemp $souscriptionTemp, String $remainDate)
    {
        $this->souscriptionTemp = $souscriptionTemp;
        $this->remainDate = $remainDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Rappel] - finalisation inscription - '.$this->souscriptionTemp->programme->nom)
        ->markdown('emails.remind-leads-to-subscribe',[
            'souscriptionTemp'=>$this->souscriptionTemp,
            'remainDate'=>$this->remainDate
        ])
        ->replyTo(config('mail.cc'));
    }
}
