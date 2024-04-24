<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Yard;
use App\Models\Track;
use App\Models\TrackSection;
use Carbon\Carbon;
class TrackReportForm extends Component
{
    public $selectedYards , $selectedTracks ;


    public function render()
    {
        $currentDateTime = Carbon::now();

        /*dd($currentDateTime->setTimezone('America/Mexico_City')->format('Y-m-d'));*/
        $currentDateTime = $currentDateTime->setTimezone('America/Mexico_City')->format('Y-m-d');
        $user=User::find(auth()->id());
        $yards=$user->yards;
        $yards_id=$yards->pluck('id');
        if (isset($yards)) {
            $yards=Yard::whereIn('id',$yards_id)->pluck('name','id')->toArray();
            $yards_id=$yards;

        } else {
            $yards=Yard::whereIn('id',$yards_id)->pluck('name','id')->toArray();
        }
        if (!$this->selectedYards) {
            /*if ($this->selectedYards ==='0'){
                $tracks=Track::whereIn('yard_id',$yards_id)->pluck('name','id')->toArray();
            }else{
                $tracks=Track::whereIn('yard_id',$yardsId)->pluck('name','id')->toArray();
            }*/
            $tracks=Track::whereIn('yard_id',$yards_id)->pluck('name','id')->toArray();
        } else {
                $tracks=Track::tracks($this->selectedYards)->pluck('name','id')->toArray();
        }
        $tracks_id=array_keys($tracks);
        if (!$this->selectedTracks) {
            $tracksections=TrackSection::whereIn('track_id',$tracks_id)->pluck('name','id')->toArray();

        } else {
            $tracksections=TrackSection::tracksections($this->selectedTracks)->pluck('name','id')->toArray();
        }
        return view('livewire.track-report-form',compact('user','yards','tracks','tracksections','currentDateTime'));
    }
}
