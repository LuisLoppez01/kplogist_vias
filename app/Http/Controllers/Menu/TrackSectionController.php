<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\TrackSection;
use App\Models\Track;
use Illuminate\Http\Request;
use Livewire\WithPagination;
class TrackSectionController extends Controller
{
    use WithPagination;
    protected $paginationTheme="bootstrap";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracksections = TrackSection::paginate(8);
        return view('menu.tracksections.index',compact('tracksections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tracks=Track::pluck('name','id')->toArray();
        return view('menu.tracksections.create',compact('tracks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',


        ]);
        $tracksection=TrackSection::create([
            'name' => $request->name,
            'track_id'=>$request->track_id,
        ]);


        return redirect()->route('menu.tracksections.index')->with('info','Se registró el tramo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackSection $tracksection)
    {
        $tracks=Track::pluck('name','id')->toArray();
        return view('menu.tracksections.edit',compact('tracksection','tracks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackSection $tracksection)
    {
        $request->validate([
            'name' => 'required',

        ]);
        $tracksection->update([
            'name' => $request->name,
            'track_id'=>$request->track_id
        ]);

        return redirect()->route('menu.tracksections.index',$tracksection)->with('info','Se actualizó el tramo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackSection $tracksection)
    {
        $tracksection->delete();
        return redirect()->route('menu.tracksections.index')->with('info','Se eliminó el tramo correctamente');
    }

}
