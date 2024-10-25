<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Livewire\WithPagination;


class CompanyController extends Controller
{
    protected $model = Company::class;

    protected $paginationTheme="bootstrap";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $companies = Company::paginate(8);
        return view('menu.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations=Location::pluck('name','id')->toArray();

        return view('menu.companies.create',compact('locations'));
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
/*            'RFC'=> 'required',*/

        ]);
        $company=Company::create([
            'name' => $request->name,
/*            'RFC' => $request->RFC,*/
            'location_id'=>$request->location_id,
        ]);


        return redirect()->route('menu.companies.index')->with('info','Se registró la empresa correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('menu.companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $locations=Location::pluck('name','id')->toArray();
        return view('menu.companies.edit',compact('company','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
/*            'RFC'=> 'required',*/
            'location_id' => 'required'
        ]);
        $company->update([
            'name' => $request->name,
/*            'RFC' => $request->RFC,*/
            'location_id'=>$request->location_id
        ]);

        return redirect()->route('menu.companies.index',$company)->with('info','Se actualizó la empresa correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        $company->delete();
        return redirect()->route('menu.companies.index')->with('info','Se eliminó la empresa correctamente');
    }
}
