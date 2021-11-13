<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ParticipantList extends Component
{
    public $souscriptions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($souscriptions)
    {
        $this->souscriptions = $souscriptions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.participant-list');
    }
}
