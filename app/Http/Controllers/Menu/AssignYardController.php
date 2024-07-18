<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\AssignYard;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Yard;


class AssignYardController extends Controller
{
    protected $model = AssignYard::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());
        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $users = User::paginate(8);
        }else{
            $users = User::where('company_id', $user->company_id)
                ->paginate(8);
        }
        return view('menu.assignyards.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.assignyards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('menu.assignyards.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::find($user);
        $useryard = $user->yards;
        //$yards=Yard::where('company_id',$user->company_id)->get();
        //@dump($user->company->name);
        if ($user->company->name == "KPLOGISTICS"){
            $yards=Yard::all();
        }else{
            $yards=Yard::where('company_id',$user->company_id)->get();
        }

        return view('menu.assignyards.edit',compact('user','yards','useryard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = User::find($user);
        $user->yards()->sync($request->yard_id);
        return redirect()->route('menu.assignyards.index', $user)->with('info','Se actualizó al usuario correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
