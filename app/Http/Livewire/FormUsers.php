<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\Company;
use App\Models\Yard;
use function Webmozart\Assert\Tests\StaticAnalysis\boolean;

class FormUsers extends Component
{
    public $selectedCompany;

    public function render()
    {
//        dd($this->selectedCompany);
        $roles=Role::all();
        $companies= Company::pluck('name', 'id')->toArray();
        $companies_id=$companies;
//        dd($companies_id);

        $route= 'menu.users.create';
//        $yards=Yard::whereIn('company_id',$companies_id)->get();

        if (!$this->selectedCompany) {
//            $yards=Yard::whereIn('company_id',$companies_id)->pluck('name','id')->toArray();
            $yards=Yard::whereIn('company_id',$companies_id)->get();

        } else {
//            $yards=Yard::yard($this->selectedCompany)->pluck('name','id')->toArray();
            $yards=Yard::yard($this->selectedCompany)->get();
        }



        return view('livewire.form-users',compact('roles','companies','route','yards'));
    }
}
