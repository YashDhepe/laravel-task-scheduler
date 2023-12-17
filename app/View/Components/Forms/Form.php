<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Form extends Component
{
    public $formId,$submitBtnGroupClass,$formActionType,$formAction;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($formId,$submitBtnGroupClass='d-block',$formActionType='',$formAction = null)
    {
        $this->formId = $formId;
        $this->submitBtnGroupClass = $submitBtnGroupClass;
        $this->formActionType = $formActionType;
        $this->formAction = $formAction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.form');
    }
}
