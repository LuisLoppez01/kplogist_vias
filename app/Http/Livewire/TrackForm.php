<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Yard;

class TrackForm extends Component
{
    public $selectedCompany,$selectedYard, $company, $yards;
    public  $route, $track, $components, $companies, $companies_id;
    public $name, $type_track,$type_tracksleeper_one,$type_tracksleeper_two,$lenght_tracksleeper_one,$lenght_tracksleeper_two,$lenght_rails_one,$lenght_rails_two,
    $weight_rails_one,$weight_rails_two;
    public function mount(){
        $this->name = old('name',"");
        $this->type_track = old('type_track',"");
        $this->lenght_tracksleeper_one = old('lenght_tracksleeper_one',"");
        $this->lenght_tracksleeper_two = old('lenght_tracksleeper_two',"");
        $this->type_tracksleeper_one = old('type_tracksleeper_one',"");
        $this->type_tracksleeper_two = old('type_tracksleeper_two',"");
        $this->lenght_rails_one = old('lenght_rails_one',"");
        $this->lenght_rails_two = old('lenght_rails_two',"");
        $this->weight_rails_one = old('weight_rails_one',"");
        $this->weight_rails_two = old('weight_rails_two',"");
    }

    public function render()
    {
//        dump(session()->all());
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
