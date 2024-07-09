<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Yard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Inspection;
use Livewire\WithPagination;

class InspectionReport extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search;
    public $companySearch;
    public $yardsIds;
    protected $queryString = ['search'];

    public function render()
    {
        /*        $inspections=Inspection::where('user_id', 'LIKE', '%'.$this->search. '%')
                    ->paginate(8);
                return view('livewire.inspection-report',compact('inspections'));*/


        $user = Auth::user();
        $companies = Company::pluck('name', 'id')->toArray();
        $this->yardsIds = Yard::where('company_id', $this->companySearch)->pluck('id')->toArray();
        /*     dump($this->yardIds);*/
        $ds = Inspection::where('active', 1)
            ->where('sent', 0)
            ->when($this->yardsIds, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereIn('yard_id', $this->yardsIds);
                });
            })
            ->paginate(8);
        $yards = Yard::pluck('name', 'id')->toArray();
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $inspections = Inspection::where('active', 1)
                ->where('sent', 0)
                ->when($this->search, function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->WhereIn('yard_id', $this->yardsIds);
                    });
                })
                ->paginate(8);
        } else {
            $inspections = collect(); // Retorna una colección vacía si no es Admin ni CorporativoKP
        }


        return view('livewire.inspection-report', compact('inspections', 'companies', 'yards', 'ds'));

    }

    public function limpiar_page()
    {
        $this->resetPage();
    }
}
