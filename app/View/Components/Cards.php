<?php

namespace App\View\Components;

use Illuminate\View\Component;


class Cards extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $description;
    public $trackId;


    public function __construct($title,$description,$trackId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->trackId = $trackId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $array = $this->trackId;
//        dump($array);
        return view('components.cards');
    }
}
