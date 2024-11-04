<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspection;        // Para manejar inspecciones
use App\Models\RailroadSwitch;   // Para manejar cambios de vía
use App\Models\AssignYard;       // Para manejar la asignación de patios
use App\Models\TrackSection;      // Para manejar secciones de vías
use App\Models\User;             // Para manejar usuarios
use App\Models\Yard;             // Para manejar patios
use App\Models\Track;   

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(auth()->id());

        

    if ($user->getRoleNames()->first() == "Admin" || $user->getRoleNames()->first() == "Coorporativo KP") {
        // Para roles de Admin o Coorporativo KP, obtenemos todos los yards con las relaciones necesarias
        $yards = Yard::with([
            'tracks.tracksections.latestInspection', // Incluir la última inspección de cada tracksection
            'railroadSwitches.latestInspection'      // Incluir la última inspección de cada railroadSwitch
        ])->get();
    } else {
        // Para otros usuarios, solo obtenemos los yards asignados al usuario con las relaciones necesarias
        $yards = $user->yards()->with([
            'tracks.tracksections.latestInspection',
            'railroadSwitches.latestInspection'
        ])->orderBy('id', 'asc')->get();
    }

    // Extraer las relaciones a nivel individual si necesitas solo listas de `tracks`, `railroadSwitches`, o `tracksections`
    $tracks = $yards->pluck('tracks')->flatten();
    $railroadSwitches = $yards->pluck('railroadSwitches')->flatten();
    $tracksections = $tracks->pluck('tracksections')->flatten();

    return response()->json([
        'yards' => $yards,
        'tracks' => $tracks,
        'railroadSwitches' => $railroadSwitches,
        'tracksections' => $tracksections,
    ]);

        // Contar los estados de las inspecciones
        $boCount = $inspections->where('estado', 'BO')->count();
        $okCount = $inspections->where('estado', 'OK')->count();

        return view('menu.index', compact('boCount', 'okCount', 'yards', 'yardId'));
    }
}
