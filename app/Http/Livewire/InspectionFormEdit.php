<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ComponentCatalog;
use App\Models\Yard;
use App\Models\Track;
use App\Models\TrackSection;
use App\Models\User;
use App\Models\RailroadSwitch;
use Carbon\Carbon;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class InspectionFormEdit extends Component
{
    public $inspection,$conjuntos;
    public $selectedYard , $selectedTrack , $selectedComponent;

    public $selectedDefect;


    public $lenghtDefect;
    public function mount($inspection)
    {
        $this->selectedYard = $inspection->yard_id;
        $this->selectedTrack = $inspection->track_id;
        $this->selectedComponent = $inspection->type_inspection;

        $this->inspection = $inspection;

        $totalDefects = $this->inspection->defect_track;
        $this->lenghtDefect = count($totalDefects);
        if ($this->conjuntos == null && $this->lenghtDefect == 0){
            $this->agregarConjunto();
        }
        foreach ($totalDefects as $totalDefect){
            $this->agregarConjunto();
        }

    }
    public function agregarConjunto()
    {
        $this->conjuntos[] = ['defecto' => '', 'priorities' => '', 'comments' => ''];
    }

    public function eliminarConjunto($index)
    {
        unset($this->conjuntos[$index]);
        $this->conjuntos = array_values($this->conjuntos); // Reindexa los conjuntos

    }

    public function render()
    {
        $inspection=$this->inspection;
        $currentDateTime = Carbon::now();
        /*$currentDateTime = $currentDateTime->setTimezone('UTC');*/
        $user=User::find(auth()->id());
        $yards=$user->yards;
        $yards_id = $yards->pluck('id');

        if ($user->getRoleNames()->first() == "Admin" or $user->getRoleNames()->first() == "Coorporativo KP") {
            $yards=Yard::pluck('name','id')->toArray();
            $yards_id=$yards;
        } else {
            $yards=Yard::whereIn('id',$yards_id)->pluck('name','id')->toArray();
        }

        if (!$this->selectedYard) {
            $tracks=Track::whereIn('yard_id',$yards_id)->pluck('name','id')->toArray();
            $railroadswitches=RailroadSwitch::whereIn('yard_id',$yards_id)->pluck('name','id')->toArray();

        } else {
            $tracks=Track::track($this->selectedYard)->pluck('name','id')->toArray();
            $railroadswitches=RailroadSwitch::switch($this->selectedYard)->pluck('name','id')->toArray();
        }

        $tracks_id=array_keys($tracks);
        if (!$this->selectedTrack) {
            $tracksections=TrackSection::whereIn('track_id',$tracks_id)->pluck('name','id')->toArray();
        } else {
            $tracksections=TrackSection::tracksection($this->selectedTrack)->pluck('name','id')->toArray();
        }

        $components=ComponentCatalog::component($this->selectedComponent)->pluck('name','id')->toArray();
        $this->selectedDefect = $components;

        return view('livewire.inspection-form-edit',compact('inspection','yards','tracks','tracksections','railroadswitches','components','user','currentDateTime'))->with('info','Se guardo la inspeccion correctamente');
    }


}
