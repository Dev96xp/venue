<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::create([
            'name'=>'Rosa Quinceañera',
            'code'=> 123456,
            'user_id'=>1,
        ]);
        Gallery::create([
            'name'=>'Gabriela Mendoza Quince',
            'code'=> 456789,
            'user_id'=>1,
        ]);
        Gallery::create([
            'name'=>'Perla Rodriguez quince',
            'code'=> 741852,
            'user_id'=>2,
        ]);
    }
}
