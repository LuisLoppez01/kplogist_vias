<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $model = User::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user=User::find(17);
//        dd($user->yards);
        return view('menu.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $companies= Company::pluck('name', 'id')->toArray();
            $roles=Role::all();
        }else{
            $companies= Company::where('id', $user->company_id)
                ->pluck('name', 'id')->toArray();
            $roles = Role::all()->skip(2);
        }
        $route= 'menu.users.create';
        return view('menu.users.create', compact('companies','route', 'roles'));
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
            'email' => 'required',
            'password' => 'required',

        ]);
        $User=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>bcrypt($request->password),
            'company_id'=>$request->company_id,
        ])->assignRole($request->roles);
        /*$User->yards()->attach($request->yard_id);*/
        // $User->company()->attach($request->company_id);



        return redirect()->route('menu.users.index')->with('info','Se registró el usuario correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('menu.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $currentUser = User::find(auth()->id());
        if ($currentUser->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $companies= Company::pluck('name', 'id')->toArray();
            $roles=Role::all();
        }else{
            $companies= Company::where('id', $currentUser->company_id)
                ->pluck('name', 'id')->toArray();
            $roles = Role::all()->skip(2);
        }
        $route= 'menu.users.edit';
        return view('menu.users.edit',compact('user','companies', 'route', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'company_id' => 'required'
        ]);

        if ($user->company_id != $request->company_id){
            $user->yards()->detach();
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'company_id'=>$request->company_id
        ]);


        return redirect()->route('menu.users.index', $user)->with('info','Se actualizó la asignación correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->yards()->detach();
        $user->delete();
        return redirect()->route('menu.users.index')->with('info','Se eliminó el usuario correctamente');
    }
}
