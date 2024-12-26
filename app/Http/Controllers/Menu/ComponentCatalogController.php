<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use App\Models\ComponentCatalog;
use Illuminate\Http\Request;

class ComponentCatalogController extends Controller
{
    protected $model = ComponentCatalog::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $componentcatalogs = ComponentCatalog::paginate(8);
        return view('menu.componentcatalogs.index',compact('componentcatalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = 'create';
        return view('menu.componentcatalogs.create',compact('route'));
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
            'type_component'=> 'required',

        ],
        [
            'name.required' => 'El campo nombre es obligatorio',
            'type_component.required' => 'El campo tipo de componente es obligatorio',
        ]);
        $componentcatalogs=ComponentCatalog::create([
            'name' => $request->name,
            'type_component' => $request->type_component,
        ]);


        return redirect()->route('menu.componentcatalogs.index')->with('info','Se registró el componente correctamente');
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
    public function edit(ComponentCatalog $componentcatalog)
    {
        $route = 'edit';
        return view('menu.componentcatalogs.edit',compact('route','componentcatalog'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComponentCatalog $componentcatalog)
    {
        $request->validate([
            'name' => 'required',
            'type_component'=> 'required',

        ],
            [
                'name.required' => 'El campo nombre es obligatorio',
                'type_component.required' => 'El campo tipo de componente es obligatorio',
            ]);
        $componentcatalog->update([
            'name' => $request->name,
            'type_component' => $request->type_component
        ]);

        return redirect()->route('menu.componentcatalogs.index',$componentcatalog)->with('info','Se actualizó el componente correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComponentCatalog $componentcatalog)
    {
        $this->authorize('delete', $componentcatalog);
        $componentcatalog->delete();
        return redirect()->route('menu.componentcatalogs.index')->with('info','Se eliminó el componente correctamente');
    }
}
