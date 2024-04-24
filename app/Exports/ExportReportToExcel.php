<?php

namespace App\Exports;
use \Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use \Maatwebsite\Excel\Concerns\FromView;
class ExportReportToExcel implements FromView
{

    /**
     * @inheritDoc
     */
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function view(): View
    {
        // Retorna la vista que contiene el diseño del archivo Excel
        return view('menu.trackreports.index', [
            'reports' => $this->reports,
        ]);
    }
}
