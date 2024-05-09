<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\Yard;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $model = Email::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::all();
        return view('menu.emails.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $yards_saved=Email::join("yards","emails.yard_id","=","yards.id")
                           ->select('yards.id')->pluck('id')->toArray();
        $yards=Yard::all()
                    ->whereNotIn('id', $yards_saved)
                    ->pluck('name','id')->toArray();


        return view('menu.emails.create',compact('yards'));

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
            'list' => 'required',
            'yard_id'=> 'required'
        ]);
        $email=Email::create([
            'list' => $request->list,
            'yard_id'=> $request->yard_id
        ]);
        return redirect()->route('menu.emails.index')->with('info','Se registraron los correos satifactoriamente');
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
    public function edit(Email $email)
    {

        $email->yard->name;
        //$yards=Yard::pluck('name','id')->toArray();
        $yards_saved=Email::join("yards","emails.yard_id","=","yards.id")
                           ->select('yards.id')->pluck('id')->toArray();

        if (($clave = array_search($email->yard_id, $yards_saved)) !== false) {
            unset($yards_saved[$clave]);
        }


        $yards=Yard::all()
                    ->whereNotIn('id', $yards_saved)
                    ->pluck('name','id')->toArray();


        return view('menu.emails.edit',compact('email','yards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $request->validate([
            'list' => 'required',
            'yard_id'=> 'required'
        ]);
        $email->update([
            'list' => $request->list,
            'yard_id'=> $request->yard_id
        ]);

        return redirect()->route('menu.emails.index',$email)->with('info','se actualizó satifactoriamente');
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
