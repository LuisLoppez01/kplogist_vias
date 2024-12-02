<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    const EMPTY = 1;
    const LOADED = 2;
    const BO = 0;
    const OK = 1;


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function yard()
    {
        return $this->belongsTo('App\Models\Yard');
    }

    public function track()
    {
        return $this->belongsTo('App\Models\Track');
    }

    public function tracksection()
    {
        return $this->belongsTo('App\Models\TrackSection');
    }

    public function railroadswitch()
    {
        return $this->belongsTo('App\Models\RailroadSwitch');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function defect_track()
    {
        return $this->hasMany('App\Models\DefectTrack');
    }
    /*public function tracksection(){
        return $this->belongsTo('App\Models\TrackSection');
    }*/
    //Relacion polimortica uno a uno
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }
    public function getTrackVerification($track, $condition)
    {
        $rcondition = [];

        if (($track->tracksections)->isEmpty()) {
            return 'bg-danger';
        }

        foreach ($track->tracksections as $tracksection) {
            if ($tracksection->inspectionsForTrackSection->count() > 0) {
                $lastInspection = $tracksection->inspectionsForTrackSection
                    ->sortByDesc('id')
                    ->first();
                if ($lastInspection->active == 2) {
                    $rcondition[] = 'bg-danger';
                } elseif ($lastInspection->active == 1) {
                    if ($lastInspection->condition == 1) {
                        $rcondition[] = 'bg-warning';
                    } elseif ($lastInspection->condition == 0 && $condition != 'bg-warning' && $condition != 'bg-danger') {
                        $rcondition[] = 'bg-success';
                    }
                }


            } else {
                return 'bg-danger';
            }
        }
        if (in_array('bg-danger', $rcondition)) {
            return 'bg-danger';
        } elseif (in_array('bg-warning', $rcondition)) {
            return 'bg-warning';
        } else {
            return 'bg-success';
        }
    }

    public function getRailraoadSwtichVerification($railroadswitch)
    {
        $rcondition = [];
        if ($railroadswitch->inspections->count() > 0){
            $lastInspection = $railroadswitch->inspections
                ->sortByDesc('id')
                ->first();
            if ($lastInspection->active == 2){
                $rcondition[]= 'bg-danger';
            }elseif($lastInspection->active == 1){
                if ($lastInspection->condition == 1) {
                    $rcondition[]= 'bg-warning';
                } elseif ($lastInspection->condition == 0 /*&& $condition != 'bg-warning' && $condition != 'bg-danger'*/) {
                    $rcondition[]= 'bg-success';
                }
            }
        }else{
            return 'bg-danger';
        }
        if (in_array('bg-danger', $rcondition)) {
            return 'bg-danger';
        } elseif (in_array('bg-warning', $rcondition)) {
            return 'bg-warning';
        } else {
            return 'bg-success';
        }
    }

    public function getTrackSectionVerification($tracksection)
    {//        return  'bg-danger';
        $rcondition = [];
        if ($tracksection->inspectionsForTrackSection->count() > 0){
            $lastInspection = $tracksection->inspectionsForTrackSection
                ->sortByDesc('id')
                ->first();
            if ($lastInspection->active == 2){
                $rcondition[] = 'bg-danger';
            }elseif($lastInspection->active == 1){
                if ($lastInspection->condition == 1) {
                    $rcondition[] = 'bg-warning';
                } elseif ($lastInspection->condition == 0 /*&& $condition != 'bg-warning' && $condition != 'bg-danger'*/) {
                    $rcondition[] = 'bg-success';
                }
            }
        }else{
            return  'bg-danger';
        }
        if (in_array('bg-danger', $rcondition)) {
            return 'bg-danger';
        } elseif (in_array('bg-warning', $rcondition)) {
            return 'bg-warning';
        } else {
            return 'bg-success';
        }
    }

    public function defects()
{
    return $this->hasMany(DefectTrack::class);
}

}
