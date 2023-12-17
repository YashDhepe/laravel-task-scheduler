<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $cardClass,$cardBodyClass;

    public function __construct($cardClass=null,$cardBodyClass=null)
    {
        $this->cardClass = $cardClass;
        $this->cardBodyClass = $cardBodyClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.card');
    }
}
