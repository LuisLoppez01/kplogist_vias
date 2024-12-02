<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Status::create(['name' => 'Vigente']);
        Status::create(['name' => 'Vencida']);
        Status::create(['name' => 'Archivada']);
    }
}
