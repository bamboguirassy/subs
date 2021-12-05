<?php

namespace App\Mail;

use App\Models\Programme;
use App\Models\Souscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenerateTontineTranche extends Mailable
{
    use Queueable, SerializesModels;
    public $programme;
    public $souscription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Programme $programme, Souscription $souscription)
    {
        $this->programme = $programme;
        $this->souscription = $souscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tontine-tranche-start',[
            'programme'=>$this->programme,
            'souscription'=>$this->souscription
            ])
            ->subject("Rappel cotisation - Tontine - ".$this->programme->nom)
            ->replyTo(config('mail.cc'));
    }
}
