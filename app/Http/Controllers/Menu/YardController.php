<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use App\Models\Yard;
use Illuminate\Http\Request;

class YardController extends Controller
{
    protected $model = Yard::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            /*$yards = Yard::withCount('tracks')->paginate(8);*/
            $yards = $user->yards()->withCount('tracks')->orderBy('id', 'asc')->paginate(8);
            /*dump($yardss, $yards);*/
        }else{
            $yards = Yard::where('company_id', $user->company_id)
            ->withCount('tracks')->paginate(8);
        }
        return view('menu.yards.index', compact('yards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::pluck('name', 'id')->toArray();
        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $companies= Company::pluck('name', 'id')->toArray();

        }else{
            $companies= Company::where('id', $user->company_id)
                ->pluck('name', 'id')->toArray();

        }
        return view('menu.yards.create', compact('locations', 'companies'));
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

        ]);
/*        $users = User::where('name', 'Administrador')->first();*/
        $relationUser = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['Admin', 'CorporativoKP']);
        })->with('roles')->get();
        $yard = Yard::create([
            'name' => $request->name,
            'location_id' => $request->location_id,
            'company_id' => $request->company_id

        ]);
        /*dump($relationUser);*/
        foreach ($relationUser as $user) {
            $yard->users()->attach($user->id);
        }
        return redirect()->route('menu.yards.index')->with('info', 'Se registró el patio correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Yard $yard)
    {

        return view('menu.yards.show', compact('yard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Yard $yard)
    {
        $locations = Location::pluck('name', 'id')->toArray();
        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $companies= Company::pluck('name', 'id')->toArray();

        }else{
            $companies= Company::where('id', $user->company_id)
                ->pluck('name', 'id')->toArray();

        }
        return view('menu.yards.edit', compact('yard', 'locations', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Yard $yard)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required'
        ]);
        $yard->update([
            'name' => $request->name,
            'location_id' => $request->location_id,
            'company_id' => $request->company_id
        ]);

        return redirect()->route('menu.yards.index', $yard)->with('info', 'Se actualizó el patio correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Yard $yard)
    {
        $this->authorize('delete', $yard);
        $yard->users()->detach();
        $yard->delete();
        return redirect()->route('menu.yards.index')->with('info', 'Se eliminó el patio correctamente');
    }
}
