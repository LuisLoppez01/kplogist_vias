<?php

namespace App\Http\Livewire;

use App\Models\DefectTrack;
use App\Models\TrackSection;
use Livewire\Component;
use App\Models\Track;
use App\Models\User;
use App\Models\RailroadSwitch;
use App\Models\Inspection;
use App\Models\Yard;
use Illuminate\Support\Facades\DB;
class MenuCardTrack extends Component
{
    public $showModal,$showModal1,$showModal2,$showModal3,$showModal4;
    public $selectedCardYardId,$selectedCardTrackId,$selectedCardTrackSectionId,$type,$selectedInspectionId ;

    public $inspectiontracks;
    public $inspectionrailroadswitchs;
    public $inspectiontracksections;


    public function mount(){
         $this->showModal = true;

    }
    public function openModal1($YardId)
    {
        $this->selectedCardYardId = $YardId;
        $this->showModal = false;
        $this->showModal1 = true;

    }
    public function openModal2($TrackId)
    {
        $this->selectedCardTrackId = $TrackId;
        $this->showModal1 = false;
        $this->showModal2 = true;
    }
    public function openModal3($TrackSectionId,$typeee)
    {
        $this->type=$typeee;
        $this->selectedCardTrackSectionId = $TrackSectionId;
        $this->showModal1 = false;
        $this->showModal2 = false;
        $this->showModal3 = true;
    }
    public function openModal4($InspectionId)
    {
        $this->selectedInspectionId = $InspectionId;
        $this->showModal3 = false;
        $this->showModal4= true;
    }
    public function closeModal1()
    {
        $this->reset(['selectedCardYardId']);
        $this->showModal1=false;
        $this->showModal=true;
    }
    public function closeModal2()
    {
        $this->reset(['selectedCardTrackId']);
        $this->showModal2=false;
        $this->showModal1=true;
    }
    public function closeModal3()
    {
        $this->reset(['selectedCardTrackSectionId']);
        if ($this->type=='switch') {
            $this->showModal3=false;
            $this->showModal1=true;
        }else{
            $this->showModal3=false;
            $this->showModal2=true;
        }

    }
    public function closeModal4()
    {
        $this->reset(['selectedInspectionId']);
        $this->showModal4=false;
        $this->showModal3=true;
    }

    public function render()
    {
        $user = User::find(auth()->id());


         if ($user->getRoleNames()->first() == "Admin" or $user->getRoleNames()->first() == "Coorporativo KP") {
            $yards=Yard::all();

            $yards_id=$yards;
        } else {
            $yards = $user->yards()->orderBy('id','asc')->get();

/*             $yards=Yard::whereIn('id',$yards_id)->pluck('name','id')->toArray();
 */        }
        /*dd($yards);*/
        if (!$this->selectedCardYardId) {
            $yardIds = $yards->pluck('id');

            $tracks = Track::whereIn('yard_id', $yardIds)->get();
            $railroadswitches=RailroadSwitch::whereIn('yard_id',$yardIds)->get();
        } else {

            $tracks = Track::where('yard_id', $this->selectedCardYardId)->get();
            $railroadswitches=RailroadSwitch::where('yard_id',$this->selectedCardYardId)->get();
            //id track, railroadstwitch
            $tracksId = Track::where('yard_id', $this->selectedCardYardId)->pluck('id')->toArray();
            $railroadsId = RailroadSwitch::where('yard_id',$this->selectedCardYardId)->pluck('id')->toArray();
            //consultas
            $subQuerytrack = Inspection::select('track_id', DB::raw('MAX(date) as latest_date'))
                ->where('yard_id', $this->selectedCardYardId)
                ->whereIn('track_id', $tracksId)
                ->groupBy('track_id');
            $subQueryrailroad = Inspection::select('railroadswitch_id', DB::raw('MAX(date) as latest_date'))
                ->where('yard_id', $this->selectedCardYardId)
                ->whereIn('railroadswitch_id', $railroadsId)
                ->groupBy('railroadswitch_id');

            $this->inspectiontracks = Inspection::joinSub($subQuerytrack, 'latest_records', function ($join) {
                $join->on('inspections.track_id', '=', 'latest_records.track_id')
                    ->on('inspections.date', '=', 'latest_records.latest_date');
            })
                ->where('inspections.yard_id', $this->selectedCardYardId)
                ->whereIn('inspections.track_id', $tracksId)
                ->get(['inspections.*']);
            $this->inspectionrailroadswitchs = Inspection::joinSub($subQueryrailroad, 'latest_records', function ($join) {
                $join->on('inspections.railroadswitch_id', '=', 'latest_records.railroadswitch_id')
                    ->on('inspections.date', '=', 'latest_records.latest_date');
            })
                ->where('inspections.yard_id', $this->selectedCardYardId)
                ->whereIn('inspections.railroadswitch_id', $railroadsId)
                ->get(['inspections.*']);
        }

        if (!$this->selectedCardTrackId) {
            $trackIds = $tracks->pluck('id');
            $tracksections = TrackSection::whereIn('track_id', $trackIds)->get();
        } else {
            $tracksections = TrackSection::where('track_id', $this->selectedCardTrackId)->get();
        }
        $inspections = null; // Definir $inspections con un valor predeterminado

        if ($this->type === 'tramo') {
            $inspections = Inspection::where('tracksection_id', $this->selectedCardTrackSectionId)->get();
        }

        if ($this->type === 'switch') {
            $inspections = Inspection::where('railroadswitch_id', $this->selectedCardTrackSectionId)->get();
        }
        $selectedInspection=null;
        $defects= null;
        if ($this->selectedInspectionId ) {
            $selectedInspection = Inspection::where('id', $this->selectedInspectionId)->get();
            $defects= DefectTrack::where('inspection_id', $this->selectedInspectionId)->get();
        }
        //buscar las vias con respecto a los patios que tiene el usuario
        /* foreach ($yards as $yard) {
            $tracks[] = (Track::where('yard_id', $yard->id)
                ->get());
        }
        foreach ($tracks as $track) {
            foreach ($track as $array) {
                $merge_tracks[] = $array;
            }
        }
        //buscar los tramos de vía con respecto a las vías
        foreach ($merge_tracks as $merge_track) {
            $tracksections[] = (TrackSection::where('track_id', $merge_track->id)
                ->get());
        }
        foreach ($tracksections as $tracksection) {
            foreach ($tracksection as $array) {
                $merge_tracksections[] = $array;
            }
        } */

        $priorityOptions = [
            0 => 'No se agregó una prioridad',
            1 => 'Baja',
            2 => 'Media',
            3 => 'Alta',
        ];

        return view('livewire.menu-card-track', compact('yards','tracks','tracksections','user',
        'railroadswitches','inspections','selectedInspection','defects','priorityOptions'));
    }

}
