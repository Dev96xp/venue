<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      //1
      Permission::create(['name' => 'Crear cursos',]);
      //2
      Permission::create(['name' => 'Leer cursos',]);
      //3
      Permission::create(['name' => 'Actualizar cursos',]);
      //4
      Permission::create(['name' => 'Eliminar cursos',]);
      //5
      Permission::create(['name' => 'Ver dashboard',]);

      //6 - roles
      Permission::create(['name' => 'Crear role',]);
      //7
      Permission::create(['name' => 'Listar role',]);
      //8
      Permission::create(['name' => 'Editar role',]);
      //9
      Permission::create(['name' => 'Eliminar role',]);

      //10 - users
      Permission::create(['name' => 'Leer usuarios',]);
      //11
      Permission::create(['name' => 'Editar usuarios',]);
    }
}
