<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeTrack($query,$selectedYard)
    {
        if($selectedYard){
            return $query->where('yard_id', $selectedYard);
        }
    }
    public function scopeTracks($query,$selectedYards)
    {
        if($selectedYards){
            return $query->where('yard_id', $selectedYards);
        }
    }

    //Relacion inversa uno a muchos
    public function yard(){
        return $this->belongsTo('App\Models\Yard');
    }

    //Relacion inversa uno a uno
    public function carInspection(){
        return $this->belongsTo('App\Models\CarInspection');
    }
    public function component_track(){
        return $this->hasOne('App\Models\ComponentTrack');
    }


    public function tracksections(){
        return $this->hasMany('App\Models\TrackSection');
    }
    public function inspections(){
        return $this->hasMany('App\Models\Inspection');
    }
}
