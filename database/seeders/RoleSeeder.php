<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // METODO 1
        //a) Crear un role llamado Admin
        //b) Guardarlo en al variable $role
        //c) Recuperar la relacion con permissions
        //d) Finalmente le pasamos el metodo attach
        //e) Y pasarle los 11 permisos que creamos,usando su ids

        $role = Role::create(['name' => 'Admin']);
        $role->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

        $role = Role::create(['name' => 'Developer']);
        $role->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

        $role = Role::create(['name' => 'Master']);
        $role->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

        $role = Role::create(['name' => 'Customer']);
        $role->permissions()->attach([1, 2, 11]);

        // METODO 2
        // Aqui se usan los nombres, usando laravel permisos
        $role = Role::create(['name' => 'Instructor']);
        $role->syncPermissions(['Crear cursos','Leer cursos','Actualizar cursos','Eliminar cursos']);
    }
}
