<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    //Relacion uno a muchos
    public function yards(){
        return $this->hasMany('App\Models\Yard');
    }
}
