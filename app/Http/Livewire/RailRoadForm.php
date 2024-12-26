<?php

namespace App\Http\Livewire;

use App\Models\Yard;
use Livewire\Component;
class RailRoadForm extends Component
{
    public $selectedCompany,$selectedYard, $company, $yards;
    public   $railroadswitch, $companies, $companies_id, $name, $type_switch;

    public function mount(){
        $this->name = old('name',"");
        $this->type_switch = old('type_switch',"");
    }
    public function render()
    {
        if ($this->railroadswitch && !$this->selectedCompany) {
            $this->company = $this->railroadswitch->yard->company->id;
            $this->selectedCompany = $this->company;
            $this->selectedYard = $this->railroadswitch->yard->id;
        }
        if (!$this->selectedCompany) {
            $this->yards=Yard::whereIn('company_id',$this->companies)->pluck('name','id')->toArray();
        }else{
            $this->yards=Yard::yard($this->selectedCompany)->pluck('name','id')->toArray();
        }
//        $this->yards=Yard::pluck('name','id')->toArray();
        return view('livewire.rail-road-form',[
            'companies' => $this->companies,
            'company' => $this->company,
            'yards' => $this->yards,
            'railroadswitch' => $this->railroadswitch,
        ]);
    }
}
