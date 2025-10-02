<?php

namespace Database\Seeders;

use App\Models\Photoshot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoshotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Genera 100 registros de prueba y los asigna al mismo tiempo a una variable
        $products = Photoshot::factory(100)->create();
    }
}
