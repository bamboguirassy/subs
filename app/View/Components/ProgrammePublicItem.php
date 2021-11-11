<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProgrammePublicItem extends Component
{
    public $programme;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($programme)
    {
        $this->programme = $programme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.programme-public-item');
    }
}
