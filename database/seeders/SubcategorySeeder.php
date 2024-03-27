<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [

            //Categoria - Quince dress (id=1)
            [
                'category_id' => 1,
                'name' => 'Vizcaya',
                'slug' => str::slug('vizcaya'),
                'color' => true,
                'brand_id' => 1
            ],

            [
                'category_id' => 1,
                'name' => 'Valencia',
                'slug' => str::slug('valencia'),
                'brand_id' => 1

            ],

            //Categoria - Prom dress (id=2)
            [
                'category_id' => 2,
                'name' => 'Long dresses',
                'slug' => str::slug('long-dress'),
                'color' => true,
                'size' => true,
                'brand_id' => 1
            ],
            [
                'category_id' => 2,
                'name' => 'Short dresses',
                'slug' => str::slug('short-dress'),
                'color' => true,
                'size' => true,
                'brand_id' => 1
            ],
            [
                'category_id' => 3,
                'name' => 'Paquetes 2022',
                'slug' => str::slug('paquetes-2022'),
                'color' => true,
                'size' => true,
                'brand_id' =>1
            ],
            [
                'category_id' => 4,
                'name' => 'Eventos oakview',
                'slug' => str::slug('eventos-oakview'),
                'color' => true,
                'size' => true,
                'brand_id' =>1
            ],

        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::factory(1)->create($subcategory);
        }
    }
}
