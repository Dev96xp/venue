<?php

namespace Database\Seeders;

use App\Models\StatusProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusProduct::create([
            'name' => 'BORRADOR'
        ]);
        StatusProduct::create([
            'name' => 'REVISION'
        ]);
        StatusProduct::create([
            'name' => 'PUBLICADO'
        ]);
    }
}
