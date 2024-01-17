<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Registro ingresado manualmente

        $user = User::create([
            'name' => 'David Martinez',
            'email' => 'dm.images@hotmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '13087464927'
        ]);
        // Asignacion de administrador
        $user->assignRole('Admin');

        // Crear otros 20 usuarios mas
        User::factory(20)->create();
    }
}
