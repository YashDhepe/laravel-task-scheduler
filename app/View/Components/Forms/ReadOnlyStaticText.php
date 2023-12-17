<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ReadOnlyStaticText extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $width,$label,$id,$value;
    public function __construct($width,$label,$id,$value=null)
    {
        $this->width = $width;
        $this->label = $label;
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.read-only-static-text');
    }
}
