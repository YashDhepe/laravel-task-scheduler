<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label,$name,$id,$class,$placeholder,$width,$row,$col,$required,$value;
    
    public function __construct($label,$name,$id,$class,$placeholder,$width,$row,$col,$required,$value=null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->width = $width;
        $this->row = $row;
        $this->col = $col;
        $this->required = $required;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}
