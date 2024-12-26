<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Track;
use App\Models\Yard;

class TrackSectionForm extends Component
{
    public $selectedCompany, $selectedYard, $selectedTrack;
    public $companies, $companies_id, $yards, $tracks,$company, $tracksection;
    public $name;
    public function mount(){
        $this->name = old('name',"");
    }

    public function render()
    {

        if ($this->tracksection && !$this->selectedYard && !$this->selectedCompany) {
            $this->company = $this->tracksection->track->yard->company->id;
            $this->selectedCompany = $this->company;
            $this->selectedYard = $this->tracksection->track->yard->id;
            $this->selectedTrack = $this->tracksection->track->id;
        }
        if (!$this->selectedCompany) {
            $this->yards=Yard::whereIn('company_id',$this->companies)->pluck('name','id')->toArray();
        }else{
            $this->yards=Yard::yard($this->selectedCompany)->pluck('name','id')->toArray();
        }

        if (!$this->selectedYard) {
            $this->tracks=Track::whereIn('yard_id',$this->yards)->pluck('name','id')->toArray();
        }else{
            $this->tracks=Track::track($this->selectedYard)->pluck('name','id')->toArray();
        }
//       dump($this->tracksection);
        return view('livewire.track-section-form', [
            'companies' => $this->companies,
            'yards' => $this->yards,
            'tracks' => $this->tracks,
            'tracksection' => $this->tracksection,
        ]);
    }
}
