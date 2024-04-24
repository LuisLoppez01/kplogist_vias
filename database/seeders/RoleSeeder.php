<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role1 = Role::create(['name' => 'Admin']);
       $role2 = Role::create(['name' => 'CorporativoKP']);
       $role3 = Role::create(['name' => 'Coordinador']);
       $role4 = Role::create(['name' => 'Supervisor']);
       $role5 = Role::create(['name' => 'InspectorKP']);

       Permission::create(['name' => 'Bienvenida'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);

       Permission::create(['name' => 'Ubicaciones'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Empresas'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Patios'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Vias'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Tramos'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Herrajes'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Componentes'])->syncRoles([$role1, $role2]);

       Permission::create(['name' => 'Roles'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Usuarios'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Asignar patios'])->syncRoles([$role1, $role2]);

       Permission::create(['name' => 'Inspecciones'])->syncRoles([$role1, $role2, $role3,$role4]);
       Permission::create(['name' => 'Realizar inspeccion'])->syncRoles([$role1, $role2, $role5]);
       Permission::create(['name' => 'Correos'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'Reportes'])->syncRoles([$role1, $role2, $role3, $role4]);
       Permission::create(['name' => 'Tarjetas Vias'])->syncRoles([$role1, $role2, $role3, $role4]);



    }
}
