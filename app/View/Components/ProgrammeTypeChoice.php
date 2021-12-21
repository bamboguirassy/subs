<?php

namespace App\View\Components;

use App\Models\Programme;
use App\Models\TypeProgramme;
use Illuminate\View\Component;

class ProgrammeTypeChoice extends Component
{
    public $typeProgrammes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->typeProgrammes = TypeProgramme::where('enabled',true)->orderBy('nom')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.programme-type-choice');
    }
}
