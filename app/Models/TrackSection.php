<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackSection extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeTrackSection($query,$selectedTrack)
    {
        if($selectedTrack){
            return $query->where('track_id', $selectedTrack);
        }

    }
    public function scopeTrackSections($query,$selectedTracks)
    {
        if($selectedTracks){
            return $query->where('track_id', $selectedTracks);

        }

    }
    public function track(){
        return $this->belongsTo('App\Models\Track');
    }
    public function inspectionsForTrackSection(){
        return $this->hasMany('App\Models\Inspection','tracksection_id');
    }
    // En App\Models\TrackSection
    public function latestInspection()
    {
        return $this->hasOne('App\Models\Inspection','tracksection_id')->latestOfMany();
    }

}
