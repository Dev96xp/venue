<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // METODO 2

        Color::create([
            'code' => 1000,
            'name' => 'White'
        ]);
        Color::create([
            'code' => 1001,
            'name' => 'Blue'
        ]);
        Color::create([
            'code' => 1002,
            'name' => 'Red'
        ]);
        Color::create([
            'code' => 1003,
            'name' => 'Black'
        ]);
    }
}
