<?php

namespace Database\Seeders;

use App\Models\CarType;
use App\Models\Company;
use App\Models\ComponentTrack;
use App\Models\Initial;
use App\Models\Location;
use App\Models\Track;
use App\Models\User;
use App\Models\Yard;
use App\Models\TrackSection;
use App\Models\RailroadSwitch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $locations=['Veracruz','Hermosillo','Hidalgo','Coahuila', 'Monterrey', 'Chiapas', 'Tijuana', 'CDMX', 'San Luis Potosí', 'Oaxaca'];
        foreach ($locations as $location) {
            Location::create([
                'name' => $location,
            ]);
        }
        $locations=Location::all();

        foreach($locations as $location){
            Company::factory(10)->create([
                'location_id'=>$location->id
            ]);
        }
        $companies=Company::all();
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'company_id' => $companies[rand(1,count($companies)-1)]->id
        ])->assignRole('admin');
        $users=User::factory(15)->create();
        Initial::factory(10)->create();

        // $locations=Location::factory(10)->create();
        //$locations=['Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Chiapas', 'Chihuahua', 'Coahuila', 'Colima', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'];

        foreach ($locations as $location) {
            Yard::factory(5)->create([
                'company_id'=>$companies[rand(1,count($companies)-1)]->id,
                'location_id'=>$location->id
            ]);
        }
        $yards=Yard::all();
        foreach ($yards as $yard) {
           /*  $yard->users()->attach(User::all()->random()->id); */
            $tracks=Track::factory(3)->create([
                'yard_id'=>$yard->id
            ]);
            $railroadswitch=RailroadSwitch::factory(3)->create([
                'yard_id'=>$yard->id
            ]);
        }
        foreach ($companies as $company) {
            $company->users()->attach(User::all()->random()->id);
            $company->users()->attach(User::all()->random()->id);
            $company->users()->attach(User::all()->random()->id);
        }
        foreach ($users as $user){
            $user->yards()->attach(Yard::all()->random()->id);
            $user->yards()->attach(Yard::all()->random()->id);
        }

        $CarTypes=['A','B','C'];
        foreach ($CarTypes as $CarType) {
            CarType::factory(1)->create([
                'name' => $CarType,
            ]);
        }

        $tracks=Track::all();
        foreach ($tracks as $track) {
            ComponentTrack::factory(1)->create([
                'track_id'=>$track->id
            ]);
            for ($i=1; $i < 6; $i++) {
                TrackSection::factory(1)->create([
                    'name'=>'Tramo '.$i,
                    'track_id'=>$track->id
                ]);
            }

         }


    }
}
