<?php

namespace App\Mail;

use App\Models\AppelFond;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdviseNewAppelFond extends Mailable
{
    use Queueable, SerializesModels;
    public $appelFond;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppelFond $appelFond)
    {
        $this->appelFond = $appelFond;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.advise-new-appel-fond',['appelFond'=>$this->appelFond])
        ->subject("Appel de fond - ".$this->appelFond->programme->nom)
        ->replyTo(config('mail.cc'));
    }
}
