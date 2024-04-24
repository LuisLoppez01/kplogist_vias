<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    //Relacion uno a munchos
    public function yards(){
        return $this->hasMany('App\Models\Yard');
    }

    //RElacion muchos a muchos
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
    public function tracksection(){
        return $this->belongsToMany('App\Models\TrackSection');
    }
     //Relacion inversa uno a muchos
     public function location(){
        return $this->belongsTo('App\Models\Location');
    }
}
