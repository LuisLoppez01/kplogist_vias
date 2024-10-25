<?php



namespace App\Http\Livewire;



use App\Models\ComponentCatalog;

use Livewire\Component;

use App\Models\Yard;

use App\Models\Track;

use App\Models\TrackSection;

use App\Models\User;

use App\Models\RailroadSwitch;

use Carbon\Carbon;



class InspectionForm extends Component

{

    public $selectedYard , $selectedTrack , $selectedComponent;

    public $selectedDefect;

    public $conjuntos;

    public $selectedRR, $selectedTS;

    public function mount()

    {
        $this->selectedYard = old('yard_id',"");
        $this->selectedTrack = old('track_id',"");
        $this->selectedRR = old('railroadswitch_id',"");
        $this->selectedTS = old('tracksection_id',"");
        $this->selectedComponent = old('type_inspection', "2");
        $defectos = old('defecto', []);


        if (count($defectos) <= 1) {
            $this->conjuntos = [
                [
                    'defecto' => $defectos[0] ?? '',
                    'priorities' => old('priorities')[0] ?? '',
                    'comments' => old('comments')[0] ?? ''
                ]
            ];
        } else {

            $this->conjuntos = [];
            foreach ($defectos as $index => $defecto) {
                $this->conjuntos[] = [
                    'defecto' => old('defecto')[$index] ?? '',
                    'priorities' => old('priorities')[$index] ?? '',
                    'comments' => old('comments')[$index] ?? ''
                ];
            }
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

        $currentDateTime = Carbon::now();

        /*$currentDateTime = $currentDateTime->setTimezone('UTC');*/
        $user=User::find(auth()->id());
        $yards=$user->yards;
        $yards_id = $yards->pluck('id');
        //dump($yards_id);
        if ($user->getRoleNames()->first() == "Admin" or $user->getRoleNames()->first() == "Coorporativo KP") {
            $yards = $user->yards->pluck('name','id')->toArray();
            //$yards=Yard::pluck('name','id')->toArray();
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
        return view('livewire.inspection-form',compact('yards','tracks','tracksections','railroadswitches','components','user','currentDateTime'))->with('info','Se guardo la inspeccion correctamente');;

    }

}

