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
            $yards = Yard::with(['tracks.tracksections.latestInspection', 'railroadSwitches.latestInspection'])->get();
        } else {
            $yards = $user->yards()->with(['tracks.tracksections.latestInspection', 'railroadSwitches.latestInspection'])->orderBy('id', 'asc')->get();
        }
    
        $result = $yards->map(function ($yard) {
            // Obtener todas las tracksections y railroadSwitches de cada yard
            $tracksections = $yard->tracks->pluck('tracksections')->flatten();
            $railroadSwitches = $yard->railroadSwitches;
    
            // Contar tracksections
            $totalTracksections = $tracksections->count();
            $tracksectionCondition0 = $tracksections->where('latestInspection.condition', 0)->count();
            $tracksectionCondition1 = $tracksections->where('latestInspection.condition', 1)->count();
            $tracksectionWithoutInspection = $tracksections->where('latestInspection', null)->count();
    
            // Contar railroadSwitches
            $totalRailroadSwitches = $railroadSwitches->count();
            $railroadSwitchCondition0 = $railroadSwitches->where('latestInspection.condition', 0)->count();
            $railroadSwitchCondition1 = $railroadSwitches->where('latestInspection.condition', 1)->count();
            $railroadSwitchWithoutInspection = $railroadSwitches->where('latestInspection', null)->count();
    
            return [
                'yard_id' => $yard->id,
                'yard_name' => $yard->name,
                'tracksections' => [
                    'total' => $totalTracksections,
                    'condition_0' => $tracksectionCondition0,
                    'condition_1' => $tracksectionCondition1,
                    'without_inspection' => $tracksectionWithoutInspection,
                ],
                'railroadSwitches' => [
                    'total' => $totalRailroadSwitches,
                    'condition_0' => $railroadSwitchCondition0,
                    'condition_1' => $railroadSwitchCondition1,
                    'without_inspection' => $railroadSwitchWithoutInspection,
                ],
            ];
        });
    
        return response()->json($result);

    }
}
