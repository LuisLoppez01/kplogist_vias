<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\Location;
use App\Models\TrackSection;

/*use App\Models\TrackSection;*/

use App\Models\User;
use App\Models\Company;
use App\Models\Yard;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteInspeccion;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

class InspectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*  $inspections = Inspection::join('yards','inspections.yard_id', '=' , 'yards.id')
                                  ->join('companies','yards.id', '=' , 'companies.id')
                                  ->select('inspections.*','yards.id','yards.company_id',  'companies.name')
                                  ->get();  */
        $user = Auth::user();
        $yardIds = Yard::where('company_id', $user->company_id)->pluck('id');

        if ($user->hasAnyRole(['Admin', 'CorporativoKP'])) {
            $inspections = Inspection::paginate(8);
        }elseif($user->hasRole('Coordinador')){
            $yardIds = Yard::where('company_id', $user->company_id)->pluck('id');
            $inspections = Inspection::whereIn('yard_id', $yardIds)->paginate(8);
            //dd($yardIds,$inspections);
        }elseif($user->hasRole('Supervisor')){
            $inspections = Inspection::whereIn('yard_id', $user->yards->pluck('id'))->paginate(8);
        }


        elseif($user->hasRole('InspectorKP')){
            $inspections = $user->inspections()->paginate(8);
        }
        return view('menu.inspections.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.inspections.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;
        try{
            if ($request->condition == 1) {
                $request->validate([
                    'defecto.*' => 'required',
                    'priorities.*' => 'required',
                    'comments.*' => 'required|string|max:255',
                ], [
                    'defecto.*.required' => 'Por favor, seleccione un defecto.',
                    'priorities.*.required' => 'Por favor, seleccione una prioridad.',
                    'comments.*.required' => 'Por favor, rellene el comentario.',
                ]);
            }
            if ($request->type_inspection == 1) {
                $lastInspection = Inspection::where('yard_id', $request->yard_id)
                    ->where('track_id', $request->track_id)
                    ->where('tracksection_id', $request->tracksection_id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($lastInspection !== null){
                    $lastInspection->active = 3;
                    $lastInspection->save();
                }
                $inspection = Inspection::create([
                    'user_id' => auth()->id(),
                    'yard_id' => $request->yard_id,
                    'track_id' => $request->track_id,
                    'tracksection_id' => $request->tracksection_id,
                    'railroadswitch_id' => null,
                    'date' => $request->date,
                    'type_inspection' => $request->type_inspection,
                    'condition' => $request->condition,
                    'active' => 1
                ]);
            }
            if ($request->type_inspection == 2) {
                $lastInspection = Inspection::where('yard_id', $request->yard_id)
                    ->where('railroadswitch_id', $request->railroadswitch_id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($lastInspection !== null){
                    $lastInspection->active = 3;
                    $lastInspection->save();
                }
                $inspection = Inspection::create([
                    'user_id' => auth()->id(),
                    'yard_id' => $request->yard_id,
                    'track_id' => null,
                    'tracksection_id' => null,
                    'railroadswitch_id' => $request->railroadswitch_id,
                    'date' => $request->date,
                    'type_inspection' => $request->type_inspection,
                    'condition' => $request->condition,
                    'active' => 1
                ]);
            }
            if ($request->condition == 1) {
                $count = count($request->defecto);
                for ($i = 0; $i < $count; $i++) {
                    $inspection->defect_track()->create([
                        'component_catalogs_id' => $request->defecto[$i],
                        'priority' => $request->priorities[$i],
                        'comment' => $request->comments[$i]
                    ]);
                }
            }
            $inspectionId = $inspection->getKey();

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $route = 'images/InspectionImage' . $inspectionId . '.' . $image->getClientOriginalExtension();
                $url = Storage::put($route, file_get_contents($image));

                $inspection->image()->create([
                    'url' => $route
                ]);
            }
            return redirect()->route('menu.inspections.create')->with('info','Se registró la inspección correctamente');
        }catch (ValidationException $e) {
            return back()->withInput()
                ->withErrors($e->errors())
                ->with('error', 'Hubo un error al guardar la información.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        $routeName = 'menu.inspections.index';
        try {
            $this->authorize('edit', $inspection);
            return view('menu.inspections.edit', compact('inspection'));
        } catch (AuthorizationException $e) {
            return redirect()->route($routeName)->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route($routeName)->with('info', 'Ocurrió un error al acceder el recurso.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspection $inspection)
    {
        if ($request->type_inspection == 1) {
            $inspection->update([
                'user_id' => auth()->id(),
                'yard_id' => $request->yard_id,
                'track_id' => $request->track_id,
                'tracksection_id' => $request->tracksection_id,
                'railroadswitch_id' => null,
                'date' => $request->date,
                'type_inspection' => $request->type_inspection,
                'condition' => $request->condition,
            ]);
        }
        if ($request->type_inspection == 2) {
            $inspection->update([
                'user_id' => auth()->id(),
                'yard_id' => $request->yard_id,
                'track_id' => null,
                'tracksection_id' => null,
                'railroadswitch_id' => $request->railroadswitch_id,
                'date' => $request->date,
                'type_inspection' => $request->type_inspection,
                'condition' => $request->condition,
            ]);
        }
        if ($request->condition == 0) {
            $inspection->defect_track()->delete();
        }
        if ($request->condition == 1) {
            $inspection->defect_track()->delete();
            $count = count($request->defecto);
            for ($i = 0; $i < $count; $i++) {
                $inspection->defect_track()->create([
                    'component_catalogs_id' => $request->defecto[$i],
                    'priority' => $request->priorities[$i],
                    'comment' => $request->comments[$i]
                ]);
            }
        }

        //codigo de img
        return redirect()->route('menu.inspections.index')->with('info', 'Se actualizó el registro satifactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        $routeName = 'menu.inspections.index';
        try {
            $this->authorize('delete', $inspection);
            $inspection->delete();
            return redirect()->route($routeName)->with('info', 'Se eliminó la inspeccion correctamente');
        } catch (AuthorizationException $e) {
            return redirect()->route($routeName)->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route($routeName)->with('info', 'Ocurrió un error al eliminar la inspección.');
        }
    }

    public function enviarReporte()
    {
        $user = User::find(auth()->id());
        $today = Carbon::today()->toDateString();

        $inspections = Inspection::where('user_id', auth()->id())
            ->where('sent', 0)
            ->where('date', 'LIKE', '%' . $today . '%')
            ->with('defect_track')
            ->get();

        foreach ($inspections as $inspection){
            $inspection->update([
                'active' => 1,
            ]);
        }

/*        $inspection = [Inspection::where('user_id', auth()->id())
            ->where('sent', 0)
            ->where('date', 'LIKE', '%' . $today . '%')
            ->with('defect_track')
            ->first()];*/
        /* $yards = $inspections->map(function ($inspection) {
            return $inspection->yard;
        });
        $uniqueYards = $inspections->map(function ($inspection) {
            return $inspection->yard;
        })->unique('id');
        $emailLists = $uniqueYards->map(function ($yard) {
            return [
                'yard_id' => $yard->id,
                'email_list' => $yard->email->list ?? null,
            ];
        });
        $emailLists;
        return $emailLists;
        */


        if ($inspections->count() > 0) {
            $kpMailList = ['sistemas.kplogistics@gmail.com', 'Luisloppez01@gmail.com', 'joalmaes0814@gmail.com', $user->email];
            $correoEnviado = Mail::to('luis.lopez@kplogistics.com.mx')->send(new ReporteInspeccion($inspections, $today));

            if ($correoEnviado) {
                return redirect()->back()->with('info', 'El reporte ha sido enviado por correo.');
            } else {
                return redirect()->back()->with('error', 'Error al enviar el correo. Por favor, intenta de nuevo.');
            }
        } else {
            return redirect()->back()->with('error', 'No existen inspecciones');
        }


    }
}
