<?php

namespace App\View\Components;

use App\Models\Souscription;
use Illuminate\View\Component;

class SouscriptionDetails extends Component
{
    public $souscription;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Souscription $souscription)
    {
        $this->souscription = $souscription;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.souscription-details');
    }
}
