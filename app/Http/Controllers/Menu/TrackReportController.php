<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\TrackSection;
use App\Models\User;
use App\Models\Yard;
use App\Models\Track;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReportToExcel;

class TrackReportController extends Controller
{
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
        if ($request->yard_id == 0) {
            $user = User::find(auth()->id());
            $yards = $user->yards;
            $yards_id = $yards->pluck('id');
            $yards = Yard::whereIn('id', $yards_id)->pluck('id')->toArray();
            $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                ->whereIn('yard_id', $yards);

            if ($request->condition === '0' || $request->condition === '1') {
                $generatedInspection->where('condition', $request->condition);
            }
            $result = $generatedInspection->get();
        } elseif ($request->track_id == 0) {
            $tracks = Track::where('yard_id', $request->yard_id)->pluck('id')->toArray();
            $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                ->where('yard_id', $request->yard_id)
                ->whereIn('track_id', $tracks);
            if ($request->condition === '0' || $request->condition === '1') {
                $generatedInspection->where('condition', $request->condition);
            }
            $result = $generatedInspection->get();
        } elseif ($request->tracksection_id == 0) {
            $tracksections = TrackSection::where('track_id', $request->track_id)->pluck('id')->toArray();
            $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                ->where('yard_id', $request->yard_id)
                ->where('track_id', $request->track_id)
                ->whereIn('tracksection_id', $tracksections);
            if ($request->condition === '0' || $request->condition === '1') {
                $generatedInspection->where('condition', $request->condition);
            }
            $result = $generatedInspection->get();
        } else {
            $generatedInspection = Inspection::whereBetween('date', [$request->initial_date . ' 00:00:00', $request->final_date . ' 23:59:59'])
                ->where('yard_id', $request->yard_id)
                ->where('track_id', $request->track_id)
                ->where('tracksection_id', $request->tracksection_id);
            if ($request->condition === '0' || $request->condition === '1') {
                $generatedInspection->where('condition', $request->condition);
            }
            $result = $generatedInspection->get();
        }
        return Excel::download(new ExportReportToExcel($result), 'datos.xlsx');
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
