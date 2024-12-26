<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\Yard;
use App\Models\RailroadSwitch;
use Illuminate\Http\Request;

class RailroadSwitchController extends Controller
{
    protected $model = RailroadSwitch::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $railroadSwitches = RailroadSwitch::paginate(8);
        return view('menu.railroadswitches.index',compact('railroadSwitches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $yards=Yard::pluck('name','id')->toArray();
        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $companies = Company::pluck('name', 'id')->toArray();
            $companies_id = Company::pluck('id')->toArray();
        }else{
            $companies = $user->company->pluck('name','id')->toArray();
            $companies_id = $user->company->pluck('id')->toArray();
        }
        return view('menu.railroadswitches.create',compact('companies','companies_id' ));
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
            'type_switch' => 'required',
            'yard_id' => 'required',
        ],
        [
            'name.required' => 'El campo nombre es obligatorio',
            'type_switch.required' => 'El campo tipo de cambio es obligatorio',
            'yard_id.required' => 'El campo patio es obligatorio',
        ]);
        $railroadSwitch=RailroadSwitch::create([
            'name' => $request->name,
            'type_switch' => $request->type_switch,
            'yard_id'=>$request->yard_id,


        ]);
        //comentario de prueba local
        return redirect()->route('menu.railroadswitches.index')->with('info','Se registró el herraje correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RailroadSwitch $railroadSwitches)
    {
        return view('menu.railroadswitches.show',compact('railroadswitches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RailroadSwitch $railroadswitch)
    {
        $yards=Yard::pluck('name','id')->toArray();
        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $companies = Company::pluck('name', 'id')->toArray();
            $companies_id = Company::pluck('id')->toArray();
        }else{
            $companies = $user->company->pluck('name','id')->toArray();
            $companies_id = $user->company->pluck('id')->toArray();
        }
        return view('menu.railroadswitches.edit',compact('railroadswitch','companies','companies_id' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RailroadSwitch $railroadswitch)
    {
        $request->validate([
            'name' => 'required',
            'type_switch' => 'required',
            'yard_id' => 'required',
        ],
            [
                'name.required' => 'El campo nombre es obligatorio',
                'type_switch.required' => 'El campo tipo de cambio es obligatorio',
                'yard_id.required' => 'El campo patio es obligatorio',
            ]);
         $railroadswitch->update([
            'name' => $request->name,
            'type_switch' => $request->type_switch,
            'yard_id'=>$request->yard_id
        ]);

      return redirect()->route('menu.railroadswitches.index',$railroadswitch)->with('info','Se actualizó el herraje correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RailroadSwitch $railroadswitch)
    {
        $this->authorize('delete', $railroadswitch);
        $railroadswitch->delete();
        return redirect()->route('menu.railroadswitches.index')->with('info','Se eliminó el herraje correctamente');
    }
}
