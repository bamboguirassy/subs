<?php

namespace App\View\Components;

use App\Models\AppelFond;
use Illuminate\View\Component;

class UserAppelFondItem extends Component
{
    public $appelFond;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(AppelFond $appelFond)
    {
        $this->appelFond = $appelFond;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-appel-fond-item');
    }
}
