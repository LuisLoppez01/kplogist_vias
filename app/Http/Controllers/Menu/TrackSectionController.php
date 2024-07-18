<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\TrackSection;
use App\Models\Track;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\User;
class TrackSectionController extends Controller
{
    protected $model = TrackSection::class;
    use WithPagination;
    protected $paginationTheme="bootstrap";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());
        $yards = $user->yards->pluck('id')->toArray();
        $tracks = Track::whereIn('yard_id', $yards)
            ->pluck('id')->toArray();
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $tracksections = TrackSection::paginate(8);
        }else{
            $tracksections = TrackSection::whereIn('track_id', $tracks)
                ->paginate(8);
        }
        return view('menu.tracksections.index',compact('tracksections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = User::find(auth()->id());
        $yards = $user->yards->pluck('id')->toArray();

        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $tracks=Track::pluck('name','id')->toArray();
        }else{
            $tracks = Track::whereIn('yard_id', $yards)
                ->pluck('name','id')->toArray();
        }

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
        $user = User::find(auth()->id());
        $yards = $user->yards->pluck('id')->toArray();

        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $tracks=Track::pluck('name','id')->toArray();
        }else{
            $tracks = Track::whereIn('yard_id', $yards)
                ->pluck('name','id')->toArray();
        }
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
        $this->authorize('delete', $tracksection);
        $tracksection->delete();
        return redirect()->route('menu.tracksections.index')->with('info','Se eliminó el tramo correctamente');
    }

}
