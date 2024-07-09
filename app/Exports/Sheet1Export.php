<?php
namespace App\Exports;

use \Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;

use \Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Sheet1Export implements FromView, WithStyles, WithColumnWidths, ShouldAutoSize

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
        return view('menu.trackreports.sheetOne', [
            'reports' => $this->reports,
        ]);
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);
        $sheet->setAutoFilter('A1:H1');
        return [
            'A1:H1' => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => '4CAF50'],
                ],
            ],
            'A:Z' => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 15,
            'D' => 20,
            'E' => 15,
            'F' => 15,
            'G' => 10,
            'H' => 25,
        ];
    }
}
