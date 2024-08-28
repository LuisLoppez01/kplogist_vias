<?php

namespace App\Console\Commands;

use App\Models\Inspection;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ValidityCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validity:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comprobación de vigencias cada 6 meses';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $activeInspections = Inspection::where('active', 1)->get();

        $currentDate = Carbon::now();

        foreach ($activeInspections as $inspection) {
            $inspectionDate = Carbon::parse($inspection->date);


            if ($inspectionDate->diffInMonths($currentDate) >= 6) {

               /* $text = "ID: " . $inspection->id . ", Fecha: " . $inspection->date . ", Activo: " . $inspection->active . "\n";
                Storage::append("test.txt", $text);*/
                $inspection->active = 2;
                $inspection->save();
            }
        }
        $text = "[" . date("y-m-d H:i:s") ."]: ValidityCheck";
        Storage::append("test.txt", $text);
    }
}
