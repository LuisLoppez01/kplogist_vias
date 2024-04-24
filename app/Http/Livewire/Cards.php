<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cards extends Component
{
    public $trackId, $title, $description;

    public function mount($trackId, $title, $description){
        $this->trackId = $trackId;
        $this->title = $title;
        $this->description = $description;
    }

    public function render()
    {
        $array[] =  $this->trackId;
//        dump($array);
        return view('livewire.cards');
    }
}
