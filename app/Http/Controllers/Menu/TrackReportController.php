<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\RailroadSwitch;
use App\Models\TrackReport;
use App\Models\TrackSection;
use App\Models\User;
use App\Models\Yard;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReportToExcel;

class TrackReportController extends Controller
{
    protected $model = TrackReport::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu.trackreports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.trackreports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'yard_id' => 'required',
            /*'track_id' => 'required',*/

        ]);
        if ($request->type_inspection == 1) {
            if ($request->yard_id == 0) {
                $user = User::find(auth()->id());
                $yards = $user->yards;
                $yards_id = $yards->pluck('id');
                $yards = Yard::whereIn('id', $yards_id)->pluck('id')->toArray();
                $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                    ->whereIn('yard_id', $yards);

                /*if ($request->condition === '0' || $request->condition === '1') {
                    $generatedInspection->where('condition', $request->condition);
                }*/
                $result = $generatedInspection->get();
            } elseif ($request->option == 1) {
                if ($request->track_id == 0) {
                    $tracks = Track::where('yard_id', $request->yard_id)->pluck('id')->toArray();
                    $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                        ->where('yard_id', $request->yard_id)
                        ->whereIn('track_id', $tracks);
                    /*if ($request->condition === '0' || $request->condition === '1') {
                        $generatedInspection->where('condition', $request->condition);
                    }*/
                    $result = $generatedInspection->get();
                } elseif ($request->tracksection_id == 0) {
                    $tracksections = TrackSection::where('track_id', $request->track_id)->pluck('id')->toArray();
                    $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                        ->where('yard_id', $request->yard_id)
                        ->where('track_id', $request->track_id)
                        ->whereIn('tracksection_id', $tracksections);
                    /*if ($request->condition === '0' || $request->condition === '1') {
                        $generatedInspection->where('condition', $request->condition);
                    }*/
                    $result = $generatedInspection->get();
                } else {
                    $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                        ->where('yard_id', $request->yard_id)
                        ->where('track_id', $request->track_id)
                        ->where('tracksection_id', $request->tracksection_id);
                    /*if ($request->condition === '0' || $request->condition === '1') {
                        $generatedInspection->where('condition', $request->condition);
                    }*/

                    $result = $generatedInspection->get();
                }

            } elseif ($request->option == 2) {
                if ($request->railroadswitch_id == 0) {
                    $railroadswitches = RailroadSwitch::where('yard_id', $request->yard_id)->pluck('id')->toArray();
                    $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                        ->where('yard_id', $request->yard_id)
                        ->whereIn('railroadswitch_id', $railroadswitches);
                    /*if ($request->condition === '0' || $request->condition === '1') {
                        $generatedInspection->where('condition', $request->condition);
                    }*/
                    $result = $generatedInspection->get();
                } else {
                    $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                        ->where('yard_id', $request->yard_id)
                        ->where('railroadswitch_id', $request->railroadswitch_id);
                    /*if ($request->condition === '0' || $request->condition === '1') {
                        $generatedInspection->where('condition', $request->condition);
                    }*/
                    $result = $generatedInspection->get();
                }
            }

        } elseif ($request->type_inspection == 2){
            if ($request->yard_id == 0){
                $user = User::find(auth()->id());
                $yards = $user->yards;
                $yards_id = $yards->pluck('id');
                $yards = Yard::whereIn('id', $yards_id)->pluck('id')->toArray();
                $latestInspections = Inspection::whereIn('yard_id', $yards)
                    ->orderBy('date', 'desc')
                    ->take($request->inspectionNumber)
                    ->get();
                $result = $latestInspections;
            }elseif ($request->option == 1) {
                if ($request->track_id == 0) {
                    $tracks = Track::where('yard_id', $request->yard_id)->pluck('id')->toArray();
                    $latestInspections = Inspection::where('yard_id', $request->yard_id)
                        ->whereIn('track_id', $tracks)
                        ->orderBy('date', 'desc')
                        ->take($request->inspectionNumber)
                        ->get();
                    $result = $latestInspections;
                }elseif ($request->tracksection_id == 0) {
                    $tracksections = TrackSection::where('track_id', $request->track_id)->pluck('id')->toArray();
                    $latestInspections = Inspection::where('yard_id', $request->yard_id)
                        ->where('track_id', $request->track_id)
                        ->whereIn('tracksection_id', $tracksections)
                        ->orderBy('date', 'desc')
                        ->take($request->inspectionNumber)
                        ->get();
                    $result = $latestInspections;
                }else{
                    $latestInspections = Inspection::where('yard_id', $request->yard_id)
                        ->where('track_id', $request->track_id)
                        ->where('tracksection_id', $request->tracksection_id)
                        ->orderBy('date', 'desc')
                        ->take($request->inspectionNumber)
                        ->get();
                    $result = $latestInspections;
                }
            }elseif ($request->option == 2) {
                if ($request->railroadswitch_id == 0) {
                    $railroadswitches = RailroadSwitch::where('yard_id', $request->yard_id)->pluck('id')->toArray();
                    $latestInspections = Inspection::where('yard_id', $request->yard_id)
                        ->whereIn('railroadswitch_id', $railroadswitches)
                        ->orderBy('date', 'desc')
                        ->take($request->inspectionNumber)
                        ->get();
                    $result = $latestInspections;
                }else{
                    $latestInspections = Inspection::where('yard_id', $request->yard_id)
                        ->where('railroadswitch_id', $request->railroadswitch_id)
                        ->orderBy('date', 'desc')
                        ->take($request->inspectionNumber)
                        ->get();
                    $result = $latestInspections;
                }
            }
        }elseif ($request->type_inspection == 3){
            if ($request->yard_id == 0) {
                $user = User::find(auth()->id());
                $yards = $user->yards;
                $yards_id = $yards->pluck('id');
                $yards = Yard::whereIn('id', $yards_id)->pluck('id')->toArray();
                $subQueryTrackSection = Inspection::select('tracksection_id', DB::raw('MAX(date) as latest_date'))
                    ->whereIn('yard_id', $yards)
                    ->whereNotNull('tracksection_id')
                    ->groupBy('tracksection_id');

                $subQueryRailroadSwitch = Inspection::select('railroadswitch_id', DB::raw('MAX(date) as latest_date'))
                    ->whereIn('yard_id', $yards)
                    ->whereNotNull('railroadswitch_id')
                    ->groupBy('railroadswitch_id');

                $latestTrackSectionInspections = Inspection::joinSub($subQueryTrackSection, 'latest_tracksection_records', function ($join) {
                    $join->on('inspections.tracksection_id', '=', 'latest_tracksection_records.tracksection_id')
                        ->on('inspections.date', '=', 'latest_tracksection_records.latest_date');
                })
                    ->whereIn('inspections.yard_id', $yards)
                    ->whereNotNull('inspections.tracksection_id')
                    ->get(['inspections.*']);

                $latestRailroadSwitchInspections = Inspection::joinSub($subQueryRailroadSwitch, 'latest_railroadswitch_records', function ($join) {
                    $join->on('inspections.railroadswitch_id', '=', 'latest_railroadswitch_records.railroadswitch_id')
                        ->on('inspections.date', '=', 'latest_railroadswitch_records.latest_date');
                })
                    ->whereIn('inspections.yard_id', $yards)
                    ->whereNotNull('inspections.railroadswitch_id')
                    ->get(['inspections.*']);
                $latestInpsections = $latestTrackSectionInspections->merge($latestRailroadSwitchInspections);
                $result = $latestInpsections->count() === 1 ? collect($latestInpsections ? [$latestInpsections] : []) : $latestInpsections;
            }elseif ($request->option == 1){
                if ($request->track_id == 0) {
                    $tracks = Track::where('yard_id', $request->yard_id)->pluck('id')->toArray();
                    $subQueryTrackSection = Inspection::select('tracksection_id', DB::raw('MAX(date) as latest_date'))
                        ->where('yard_id', $request->yard_id)
                        ->whereIn('track_id', $tracks)
                        ->whereNotNull('tracksection_id')
                        ->groupBy('tracksection_id');

                    $latestTrackSectionInspections = Inspection::joinSub($subQueryTrackSection, 'latest_tracksection_records', function ($join) {
                        $join->on('inspections.tracksection_id', '=', 'latest_tracksection_records.tracksection_id')
                            ->on('inspections.date', '=', 'latest_tracksection_records.latest_date');
                    })
                        ->where('inspections.yard_id', $request->yard_id)
                        ->whereIn('inspections.track_id', $tracks)
                        ->whereNotNull('inspections.tracksection_id')
                        ->get(['inspections.*']);

                    $result = $latestTrackSectionInspections->count() === 1 ? collect($latestTrackSectionInspections ? [$latestTrackSectionInspections] : []) : $latestTrackSectionInspections;
                }elseif ($request->tracksection_id == 0) {
                    $tracksections = TrackSection::where('track_id', $request->track_id)->pluck('id')->toArray();
                    $subQueryTrackSection = Inspection::select('tracksection_id', DB::raw('MAX(date) as latest_date'))
                        ->where('yard_id', $request->yard_id)
                        ->where('track_id', $request->track_id)
                        ->whereIn('tracksection_id', $tracksections)
                        ->groupBy('tracksection_id');

                    // Obtener las últimas inspecciones para cada tracksection_id
                    $latestTrackSectionInspections = Inspection::joinSub($subQueryTrackSection, 'latest_tracksection_records', function ($join) {
                        $join->on('inspections.tracksection_id', '=', 'latest_tracksection_records.tracksection_id')
                            ->on('inspections.date', '=', 'latest_tracksection_records.latest_date');
                    })
                        ->where('inspections.yard_id', $request->yard_id)
                        ->where('inspections.track_id', $request->track_id)
                        ->whereIn('inspections.tracksection_id', $tracksections)
                        ->get(['inspections.*']);

                    $result = $latestTrackSectionInspections->count() === 1 ? collect($latestTrackSectionInspections ? [$latestTrackSectionInspections] : []) : $latestTrackSectionInspections;

                }else{
                    $subQueryTrackSection = Inspection::select('tracksection_id', DB::raw('MAX(date) as latest_date'))
                        ->where('yard_id', $request->yard_id)
                        ->where('track_id', $request->track_id)
                        ->where('tracksection_id', $request->tracksection_id)
                        ->groupBy('tracksection_id');

                    $latestTrackSectionInspection = Inspection::joinSub($subQueryTrackSection, 'latest_tracksection_records', function ($join) {
                        $join->on('inspections.tracksection_id', '=', 'latest_tracksection_records.tracksection_id')
                            ->on('inspections.date', '=', 'latest_tracksection_records.latest_date');
                    })
                        ->where('inspections.yard_id', $request->yard_id)
                        ->where('inspections.track_id', $request->track_id)
                        ->where('inspections.tracksection_id', $request->tracksection_id)
                        ->first(['inspections.*']);
                    $inspectionCollection = collect($latestTrackSectionInspection ? [$latestTrackSectionInspection] : []);
                    $result = $inspectionCollection;
                }
            }elseif ($request->option == 2){
                if ($request->railroadswitch_id == 0) {
                    $railroadswitches = RailroadSwitch::where('yard_id', $request->yard_id)->pluck('id')->toArray();
                    $subQueryRailroadSwitch = Inspection::select('railroadswitch_id', DB::raw('MAX(date) as latest_date'))
                        ->where('yard_id', $request->yard_id)
                        ->whereIn('railroadswitch_id', $railroadswitches)
                        ->whereNotNull('railroadswitch_id')
                        ->groupBy('railroadswitch_id');

                    $latestRailroadSwitchInspections = Inspection::joinSub($subQueryRailroadSwitch, 'latest_railroadswitch_records', function ($join) {
                        $join->on('inspections.railroadswitch_id', '=', 'latest_railroadswitch_records.railroadswitch_id')
                            ->on('inspections.date', '=', 'latest_railroadswitch_records.latest_date');
                    })
                        ->where('inspections.yard_id', $request->yard_id)
                        ->whereIn('inspections.railroadswitch_id', $railroadswitches)
                        ->whereNotNull('inspections.railroadswitch_id')
                        ->get(['inspections.*']);
                    $result = $latestRailroadSwitchInspections->count() === 1 ? collect($latestRailroadSwitchInspections ? [$latestRailroadSwitchInspections] : []) : $latestRailroadSwitchInspections;
                }else{
                    $subQueryRailroadSwitch = Inspection::select('railroadswitch_id', DB::raw('MAX(date) as latest_date'))
                        ->where('yard_id', $request->yard_id)
                        ->where('railroadswitch_id', $request->railroadswitch_id)
                        ->groupBy('railroadswitch_id');

                    $latestRailroadSwitchInspections = Inspection::joinSub($subQueryRailroadSwitch, 'latest_railroadswitch_records', function ($join) {
                        $join->on('inspections.railroadswitch_id', '=', 'latest_railroadswitch_records.railroadswitch_id')
                            ->on('inspections.date', '=', 'latest_railroadswitch_records.latest_date');
                    })
                        ->where('inspections.yard_id', $request->yard_id)
                        ->where('inspections.railroadswitch_id', $request->railroadswitch_id)
                        ->first(['inspections.*']);
                    $inspectionCollection = collect($latestRailroadSwitchInspections ? [$latestRailroadSwitchInspections] : []);
                    $result = $inspectionCollection;
                }
            }
        }
                /*dump($result);*/
                $response = Excel::download(new ExportReportToExcel($result), 'datos.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                ob_end_clean();
                return $response;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
