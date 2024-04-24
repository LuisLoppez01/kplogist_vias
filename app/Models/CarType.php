<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //Relacion inversa uno a uno
    public function carInspection(){
        return $this->belongsTo('App\Models\CarInspection');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function yard(){
        return $this->belongsTo('App\Models\Yard');
    }
    public function track(){
        return $this->belongsTo('App\Models\Track');
    }
}

