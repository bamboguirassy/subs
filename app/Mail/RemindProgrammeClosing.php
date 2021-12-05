<?php

namespace App\Mail;

use App\Models\Programme;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindProgrammeClosing extends Mailable
{
    use Queueable, SerializesModels;
    public $programme;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Programme $programme)
    {
        $this->programme = $programme;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.programme-closing-reminder',[
            'programme'=>$this->programme
            ])
            ->subject("Rappel Cloture - Programme: ".$this->programme->nom)
            ->replyTo(config('mail.cc'));
    }
}
