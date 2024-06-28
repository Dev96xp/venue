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
            'cus_id' => '2020-1001',
            'email' => 'dm.images@hotmail.com',
            'password' => bcrypt('12345612'),
            'phone' => '13087464927',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Admin');


        $user = User::create([
            'name' => 'Martha Hermosillo',
            'cus_id' => '2020-1001',
            'email' => 'm.hermosillo@hotmail.com',
            'password' => bcrypt('123456789'),
            'phone' => '13087464108',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Admin');


        $user = User::create([
            'name' => 'Vanessa Jovanna',
            'cus_id' => '2020-1002',
            'email' => 'vanessaj@gmail.com',
            'password' => bcrypt('123456123'),
            'phone' => '13087464108',
            'store_id' => 1,
        ]);
        // Asignacion de administrador
        $user->assignRole('Customer');

        // Crear otros 20 usuarios mas
        User::factory(4)->create();
    }
}
