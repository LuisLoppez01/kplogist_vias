<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Yard;

class TrackForm extends Component
{
    public $selectedCompany,$selectedYard, $company, $yards;
    public  $route, $track, $components, $companies, $companies_id;



    public function render()
    {
        if ($this->track && !$this->selectedCompany) {
            $this->company = $this->track->yard == null ? 0 :$this->track->yard->company->id;
            $this->selectedCompany = $this->company;
            $this->selectedYard = $this->track->yard == null ? 0 :$this->track->yard->id;
        }
        if (!$this->selectedCompany) {
            $this->yards=Yard::whereIn('company_id',$this->companies)->pluck('name','id')->toArray();
        }else{
            $this->yards=Yard::yard($this->selectedCompany)->pluck('name','id')->toArray();
        }
//        dump($company,$this->track->yard_id);
        return view('livewire.track-form', [
            'companies' => $this->companies,
            'company' => $this->company,
            'yards' => $this->yards,
            'route' => $this->route,
            'track' => $this->track,
            'components' => $this->components
        ]);
    }
}
