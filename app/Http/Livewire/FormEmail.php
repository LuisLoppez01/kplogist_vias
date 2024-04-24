<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Email;
use App\Models\User;
use App\Models\Yard;
use Livewire\Component;

class FormEmail extends Component
{
    public function render()
    {
        // Obtener el modelo del usuario actual
$user = User::find(auth()->id());
$companies = $user->company->pluck('name')->toArray();


        $yards_saved=Email::join("yards","emails.yard_id","=","yards.id")
                           ->select('yards.id')->pluck('id')->toArray();
        $yards=Yard::all()
                    ->whereNotIn('id', $yards_saved)
                    ->pluck('name','id')->toArray();
        /* $companies=Company::all()
                    ->pluck('name','id')->toArray(); */

        return view('livewire.form-email',compact('yards','companies'));
    }
}
