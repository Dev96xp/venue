<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'The palace',
            'code' => 'TH'
        ]);
        Brand::create([
            'name' => 'Morilee',
            'code' => 'MO'
        ]);
        Brand::create([
            'name' => 'Goyard',
            'code' => 'GO'
        ]);
        Brand::create([
            'name' => 'Stussy',
            'code' => 'ST'
        ]);
        Brand::create([
            'name' => 'Nike',
            'code' => 'NI'
        ]);

    }
}
