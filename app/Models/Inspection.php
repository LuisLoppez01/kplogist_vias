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


    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function yard(){
        return $this->belongsTo('App\Models\Yard');
    }
    public function track(){
        return $this->belongsTo('App\Models\Track');
    }
    public function tracksection(){
        return $this->belongsTo('App\Models\TrackSection');
    }
    public function railroadswitch(){
        return $this->belongsTo('App\Models\RailroadSwitch');
    }
    public function location(){
        return $this->belongsTo('App\Models\Location');
    }
    public function defect_track(){
        return $this->hasMany('App\Models\DefectTrack');
    }
    /*public function tracksection(){
        return $this->belongsTo('App\Models\TrackSection');
    }*/
    //Relacion polimortica uno a uno
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }

}
