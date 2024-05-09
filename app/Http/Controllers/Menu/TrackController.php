<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Yard;
use App\Models\ComponentTrack;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    protected $model = Track::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tracks = Track::all();
        $tracks = Track::paginate(8);

//        $components = ComponentTrack::all()->toArray()->keyBy('id');
       /*  $components = ComponentTrack::all()->reduce(function ($carry, $item) {
            $carry[$item->id] = [
                'id' => $item->id,
                'type_track' => $item->type_track,
                'type_tracksleeper_one' => $item->type_tracksleeper_one,
                'lenght_tracksleeper_one' => $item->lenght_tracksleeper_one,
                'type_tracksleeper_two' => $item->type_tracksleeper_two,
                'lenght_tracksleeper_two' => $item->lenght_tracksleeper_two,
                'weight_rails_one' => $item->weight_rails_one,
                'lenght_rails_one' => $item->lenght_rails_one,
                'weight_rails_two' => $item->weight_rails_two,
                'lenght_rails_two' => $item->lenght_rails_two,
                /*'railroadswitch_interior' => $item->railroadswitch_interior,
                'railroadswitch_exterior' => $item->railroadswitch_exterior,
            ];
            return $carry;}, []); */

//        dd($components[1]);
        return view('menu.tracks.index', compact('tracks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $yards = Yard::pluck('name', 'id')->toArray();
        $route = 'create';
        return view('menu.tracks.create', compact('yards', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'yard_id' => 'required',
            'type_track' => 'required',
            'type_tracksleeper_one' => 'required',
            'lenght_tracksleeper_one' => 'required',
/*          'type_tracksleeper_two' => 'required',
            'lenght_tracksleeper_two' => 'required',*/
            'weight_rails_one' => 'required',
            'lenght_rails_one' => 'required',
            /*'weight_rails_two' => 'required',
            'lenght_rails_two' => 'required',*/
            /*'railroadswitch_interior' => 'required',
            'railroadswitch_exterior' => 'required',*/
        ]);
        $track = Track::create([
            'name' => $request->name,
            'yard_id' => $request->yard_id,
        ]);
        $track->component_track()->create([
            'type_track' => $request->type_track,
            'type_tracksleeper_one' => $request->type_tracksleeper_one,
            'lenght_tracksleeper_one' => $request->lenght_tracksleeper_one,
            'type_tracksleeper_two' => $request->type_tracksleeper_two,
            'lenght_tracksleeper_two' => $request->lenght_tracksleeper_two,
            'weight_rails_one' => $request->weight_rails_one,
            'lenght_rails_one' => $request->lenght_rails_one,
            'weight_rails_two' => $request->weight_rails_two,
            'lenght_rails_two' => $request->lenght_rails_two,
            /*'railroadswitch_interior' => $request->railroadswitch_interior,
            'railroadswitch_exterior' => $request->railroadswitch_exterior,*/
        ]);

        return redirect()->route('menu.tracks.index')->with('info', 'Se registró la vía correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return view('menu.tracks.show', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        $route = 'edit';
        $yards = Yard::pluck('name', 'id')->toArray();
        $components = ComponentTrack::select('id', 'type_track', 'lenght_tracksleeper_one', 'lenght_tracksleeper_two',
            'type_tracksleeper_one', 'type_tracksleeper_two', 'weight_rails_one', 'lenght_rails_one', 'weight_rails_two', 'lenght_rails_two',
            /*'railroadswitch_interior', 'railroadswitch_exterior'*/)
            ->wheretrack_id($track->id)
            ->first();
//        dd($components);
        return view('menu.tracks.edit', compact('track', 'yards', 'components', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $request->validate([
            'name' => 'required',
            'yard_id' => 'required',
            'type_track' => 'required',
            'type_tracksleeper_one' => 'required',
            'lenght_tracksleeper_one' => 'required',
            /*'type_tracksleeper_two' => 'required',
            'lenght_tracksleeper_two' => 'required',*/
            'weight_rails_one' => 'required',
            'lenght_rails_one' => 'required',
            /*'weight_rails_two' => 'required',
            'lenght_rails_two' => 'required',*/
            /*'railroadswitch_interior' => 'required',
            'railroadswitch_exterior' => 'required',*/
        ]);
        $track->update([
            'name' => $request->name,
            'yard_id' => $request->yard_id,
        ]);
        $track->component_track()->update([
            'type_track' => $request->type_track,
            'type_tracksleeper_one' => $request->type_tracksleeper_one,
            'lenght_tracksleeper_one' => $request->lenght_tracksleeper_one,
            'type_tracksleeper_two' => $request->type_tracksleeper_two,
            'lenght_tracksleeper_two' => $request->lenght_tracksleeper_two,
            'weight_rails_one' => $request->weight_rails_one,
            'lenght_rails_one' => $request->lenght_rails_one,
            'weight_rails_two' => $request->weight_rails_two,
            'lenght_rails_two' => $request->lenght_rails_two,
            /*'railroadswitch_interior' => $request->railroadswitch_interior,
            'railroadswitch_exterior' => $request->railroadswitch_exterior,*/
        ]);

        return redirect()->route('menu.tracks.index', $track)->with('info', 'Se actualizó la vía correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $this->authorize('delete', $track);
        $track->delete();
        return redirect()->route('menu.tracks.index')->with('info', 'Se eliminó la vía correctamente');
    }
}
