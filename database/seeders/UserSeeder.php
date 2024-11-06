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
            'name' => 'Nucleos Industries',
            'cus_id' => '2024-1001',
            'email' => 'dm.images@hotmail.com',
            'password' => bcrypt('12345612'),
            'phone' => '13087464927',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Admin');


        $user = User::create([
            'name' => 'Martha Hermosillo',
            'cus_id' => '2024-1002',
            'email' => 'm.hermosillo@hotmail.com',
            'password' => bcrypt('123456789'),
            'phone' => '13087464108',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Admin');


        $user = User::create([
            'name' => 'Vanessa Jovanna',
            'cus_id' => '2024-1003',
            'email' => 'vanessaj@gmail.com',
            'password' => bcrypt('123456123'),
            'phone' => '13087464108',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Customer');

        $user = User::create([
            'name' => 'Online user sin registro',
            'cus_id' => '2024-1004',
            'email' => 'onlineuser@gmail.com',
            'password' => bcrypt('123456123'),
            'phone' => '13087464108',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Customer');

        // Crear otros 20 usuarios mas
        User::factory(4)->create();       //Lo comente pq no se puede usar en laravel forge 2024
    }
}
