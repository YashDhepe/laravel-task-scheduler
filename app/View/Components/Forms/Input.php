<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{

    public $label,$type,$name,$id,$class,$placeholder,$width,$value,$readOnly,$accept,$previewLink,$maxLength,$max;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label,$type,$name,$id,$class,$placeholder,$width,$value=null,$readOnly=null,$accept = null,$previewLink=null,$maxLength=null,$max=null)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->width = $width;
        $this->value = $value;
        $this->readOnly = $readOnly;
        $this->accept = $accept;
        $this->previewLink = $previewLink;
        $this->maxLength = $maxLength;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
