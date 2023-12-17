<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title,$modalName,$modalWidth;
    
    public function __construct($title,$modalName="global-modal",$modalWidth="w-50")
    {
        $this->title = $title;
        $this->modalName = $modalName;
        $this->modalWidth = $modalWidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.modal');
    }
}
