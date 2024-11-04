<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Inspection;        // Para manejar inspecciones
use App\Models\RailroadSwitch;   // Para manejar cambios de vía
use App\Models\AssignYard;       // Para manejar la asignación de patios
use App\Models\TrackSection;      // Para manejar secciones de vías
use App\Models\User;             // Para manejar usuarios
use App\Models\Yard;             // Para manejar patios
use App\Models\Track;            // Para manejar vías
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener patios asignados al usuario
        $assignedYards = AssignYard::where('user_id', $user->id)->pluck('yard_id');

        // Si no hay patios asignados, redirigir con mensaje
        if ($assignedYards->isEmpty()) {
            return redirect()->back()->withErrors(['yard' => 'No tienes patios asignados.']);
        }

        // Obtener el patio seleccionado, si está disponible
        $yardId = $request->input('yard_id', $assignedYards->first());

        // Obtener las vías y cambios de vía asociados al patio
        $tracks = Track::where('yard_id', $yardId)->get();
        $railroadSwitches = RailroadSwitch::where('yard_id', $yardId)->get();

        // Validar que yard_id sea proporcionado y válido
        if (!$yardId) {
            return redirect()->back()->withErrors(['yard_id' => 'El ID del patio es requerido.']);
        }

        // 1. Total de Inspecciones
        $inspections = Inspection::selectRaw('status, COUNT(*) as total')
            ->where('yard_id', $yardId)
            ->whereIn('status', ['BO', 'OK'])
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $boCount = $inspections['BO'] ?? 0;
        $okCount = $inspections['OK'] ?? 0;

        // 2. Total de Secciones de Vías
        $totalTrackSections = TrackSection::where('yard_id', $yardId)->count();
        $inspectedTrackSections = TrackSection::where('yard_id', $yardId)
            ->whereHas('inspections', function ($query) {
                $query->where('inspection_date', '>=', now()->subMonths(3));
            })->count();

        // 3. Últimos 5 Defectos Más Reportados
        $defects = Defect::selectRaw('defect, COUNT(*) as total')
            ->where('yard_id', $yardId)
            ->groupBy('defect')
            ->orderBy('total', 'desc')
            ->take(5)
            ->pluck('total', 'defect')
            ->toArray();

        // Pasar la información a la vista
       /*  return view('menu.index', compact(
            'boCount',
            'okCount',
            'totalTrackSections',
            'inspectedTrackSections',
            'defects',
            'assignedYards', // Para la selección de patios en la vista
            'tracks',        // Para las vías en la vista
            'railroadSwitches' // Para los cambios de vía en la vista
        )); */
        return view('menu.index');
    }
}
