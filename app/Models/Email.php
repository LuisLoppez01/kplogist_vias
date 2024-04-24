<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //Relacion inversa uno a uno
    public function yard(){
        return $this->belongsTo('App\Models\Yard');
    }

    
}
