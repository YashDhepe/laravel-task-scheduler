<?php

namespace App\View\Components\Dividers;

use Illuminate\View\Component;

class TextDivider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $iconName,$class;
    public function __construct($iconName,$class)
    {
        $this->$iconName = $iconName;
        $this->$class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dividers.text-divider');
    }
}
