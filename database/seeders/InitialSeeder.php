<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\ComponentCatalog;
use App\Models\Email;
use App\Models\Location;
use App\Models\User;
use App\Models\Yard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations=['Nuevo Leon','Veracruz','Coahuila', 'CDMX', 'San Luis Potosí'];
        foreach ($locations as $location) {
            Location::create([
                'name' => $location,
            ]);
        }
        Company::create([
            'name' => 'KPLOGISTICS',
            'RFC' => 'AME140809LE0',
            'location_id'=>1
        ]);
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'company_id' => 1
        ])->assignRole('admin');

        $components = [
            ['name' => 'Rieles', 'type_component' => 1],
            ['name' => 'Planchuelas', 'type_component' => 1],
            ['name' => 'Durmientes', 'type_component' => 1],
            ['name' => 'Tornillería', 'type_component' => 1],
            ['name' => 'Balasto', 'type_component' => 1],
            ['name' => 'Geometría', 'type_component' => 1],
            ['name' => 'Placas de asiento', 'type_component' => 1],
            ['name' => 'Escantillon', 'type_component' => 1],
            ['name' => 'Otros', 'type_component' => 1],
            ['name' => 'Aguja izquierda', 'type_component' => 2],
            ['name' => 'Aguja derecha', 'type_component' => 2],
            ['name' => 'Arbol de cambio', 'type_component' => 2],
            ['name' => 'Riel de apoyo', 'type_component' => 2],
            ['name' => 'Rieles', 'type_component' => 2],
            ['name' => 'Sapo', 'type_component' => 2],
            ['name' => 'Silletas', 'type_component' => 2],
            ['name' => 'Barra de ajuste', 'type_component' => 2],
            ['name' => 'Placa escantillon', 'type_component' => 2],
            ['name' => 'Blocks talón', 'type_component' => 2],
            ['name' => 'Madera de cambio', 'type_component' => 2],
            ['name' => 'Placas gemelas', 'type_component' => 2],
            ['name' => 'Otros', 'type_component' => 2],
            // ... Agrega más elementos aquí
        ];
        foreach ($components as $component) {
            ComponentCatalog::create([
                'name' => $component['name'],
                'type_component' => $component['type_component'],
            ]);
        }
        Yard::create([
            'name' => 'KPCentral',
            'city' => 'Monterrey',
            'company_id' => 1,
            'location_id' => 1,
        ]);
        Email::create([
            'list' => 'pedro.aguilar@kplogistics.com.mx,alejandro.garcia@kplogistics.com.mx,fernando.espinosa@kplogistics.com.mx',
            'yard_id' => 1
        ]);


    }
}
