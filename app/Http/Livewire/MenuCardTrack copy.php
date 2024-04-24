<?php

namespace App\Http\Livewire;

use App\Models\DefectTrack;
use App\Models\TrackSection;
use Livewire\Component;
use App\Models\Track;
use App\Models\User;
use App\Models\RailroadSwitch;
use App\Models\Inspection;



class MenuCardTrack extends Component
{
    public $showModal = false, $showModal1 = false,$showModal2 = false,$showModal3 = false,$showModal4 = false;
    public $selectedCardYardId,$selectedCardTrackId,$selectedCardTrackSectionId,$type,$selectedInspectionId ;

    public function openModal1($YardId)
    {
        $this->selectedCardYardId = $YardId;
        $this->showModal1 = true;
    }
    public function openModal2($TrackId)
    {
        $this->selectedCardTrackId = $TrackId;
        $this->showModal2 = true;
    }
    public function openModal3($TrackSectionId,$typeee)
    {
        $this->type=$typeee;
        $this->selectedCardTrackSectionId = $TrackSectionId;
        $this->showModal3 = true;
    }
    public function openModal4($InspectionId)
    {
        $this->selectedInspectionId = $InspectionId;
        $this->showModal4= true;
    }
    public function closeModal1()
    {
        $this->reset(['selectedCardYardId']);
        $this->showModal1=false;
    }
    public function closeModal2()
    {
        $this->reset(['selectedCardTrackId']);
        $this->showModal2=false;
    }
    public function closeModal3()
    {
        $this->reset(['selectedCardTrackSectionId']);
        $this->showModal3=false;
    }
    public function closeModal4()
    {
        $this->reset(['selectedInspectionId']);
        $this->showModal4=false;
    }

    public function render()
    {
        $user = User::find(auth()->id());
        $yards = $user->yards;
        if (!$this->selectedCardYardId) {
            $yardIds = $yards->pluck('id');
            $tracks = Track::whereIn('yard_id', $yardIds)->get();
            $railroadswitches=RailroadSwitch::whereIn('yard_id',$yardIds)->get();
        } else {
            $tracks = Track::where('yard_id', $this->selectedCardYardId)->get();
            $railroadswitches=RailroadSwitch::where('yard_id',$this->selectedCardYardId)->get();
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
        return view('livewire.menu-card-track', compact('yards','tracks','tracksections','user',
        'railroadswitches','inspections','selectedInspection','defects'));
       // return view('livewire.menu-card-track', compact('merge_tracks','merge_tracksections', 'tracks'));
    }

}
