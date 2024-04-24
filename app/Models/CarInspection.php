<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInspection extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    const EMPTY = 1;
    const LOADED = 2;
    const BO = 1;
    const OK = 2;
    const MATUTINO = 1;

    //Relacion uno a uno
    public function user(){
        return $this->hasOne('App\Models\User');
    }
    public function initial(){
        return $this->hasOne('App\Models\Initial');
    }
    public function carType(){
        return $this->hasOne('App\Models\CarType');
    }
    public function track(){
        return $this->hasOne('App\Models\Track');
    }
    
}
