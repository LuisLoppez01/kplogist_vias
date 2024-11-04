<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RailroadSwitch extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeSwitch($query,$selectedYard)
    {
        if($selectedYard){
            return $query->where('yard_id', $selectedYard);
        }
    }


    //Relacion inversa uno a muchos
    public function yard(){
        return $this->belongsTo('App\Models\Yard');
    }
    public function inspections(){
        return $this->hasMany('App\Models\Inspection','railroadswitch_id');
    }

    // En App\Models\TrackSection
    public function latestInspection()
    {
        return $this->hasOne('App\Models\Inspection','railroadswitch_id')->latestOfMany();
    }

}
