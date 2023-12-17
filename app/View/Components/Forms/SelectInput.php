<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $label,$name,$id,$class,$width,$options,$multiple,$placeholder,$key,$val,$optionKey;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($label,$name,$id,$class,$width,$options=null,$multiple=null,$placeholder=null,$key="name",$val = null,$optionKey = 'id')
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->label = $label;
        $this->width = $width;
        $this->options = $options;
        $this->multiple = $multiple;
        $this->placeholder = $placeholder;
        $this->key = $key;
        $this->val = $val;
        $this->optionKey = $optionKey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select-input');
    }
}
