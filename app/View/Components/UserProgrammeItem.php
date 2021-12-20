<?php

namespace App\View\Components;

use App\Models\Programme;
use Illuminate\View\Component;

class UserProgrammeItem extends Component
{
    public $programme;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Programme $programme)
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
        return view('components.user-programme-item');
    }
}
