<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectTrack extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function inspections(){
        return $this->belongsToMany('App\Models\Inspection');
    }

    public function component_catalog()
    {
        return $this->belongsTo(ComponentCatalog::class, 'component_catalogs_id');
    }

}
