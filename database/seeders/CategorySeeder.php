<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Quince dresses',
                'slug' => str ::slug('quince-dresses'),
                'icon' => '<i class="fas fa-tshirt"></i>',
                'type_category_id' => 1,
                'status_category_id' => 1,
            ],
            [
                'name' => 'Prom dresses',
                'slug' => str ::slug('prom-dresses'),
                'icon' =>'<i class="fas fa-user-graduate"></i>',
                'type_category_id' => 1,
                'status_category_id' => 1,
            ],
            [
                'name' => 'Paquetes de quince',
                'slug' => str ::slug('paquetes-de-quince'),
                'icon' =>'<i class="fas fa-user-graduate"></i>',
                'type_category_id' => 1,
                'status_category_id' => 1,
            ],
            [
                'name' => 'Paquetes de Eventos',
                'slug' => str ::slug('paquetes-de-eventos'),
                'icon' =>'<i class="fas fa-user-graduate"></i>',
                'type_category_id' => 2,
                'status_category_id' => 1,
            ],

            // [
            //     'name' => 'Paquetes de Salon Diamante',
            //     'slug' => Str::slug('paquetes-de-salon-diamante'),
            //     'icon' => '<i class="fas fa-tshirt"></i>',
            //     'type_category_id' => 1,
            //     'status_category_id' => 1,
            // ],
            // [
            //     'name' => 'Paquetes de Salon Premiun',
            //     'slug' => Str::slug('paquetes-de-salon-premiun'),
            //     'icon' =>'<i class="fas fa-user-graduate"></i>',
            //     'type_category_id' => 1,
            //     'status_category_id' => 1,
            // ],
            // [
            //     'name' => 'Paquetes de Salon Platinun',
            //     'slug' => Str::slug('paquetes-de-salon-platinun'),
            //     'icon' =>'<i class="fas fa-user-graduate"></i>',
            //     'type_category_id' => 1,
            //     'status_category_id' => 1,
            // ],
        ];

        foreach($categories as $category){
            $category = Category::factory(1)->create($category)->first();

            // Hay una relacion MUCHOS A MUCHOS, se agrtegan unos registros a las tabla intermedia
            $brands = Brand::all();
            foreach($brands as $brand){
                $brand->categories()->attach($category->id);
            }


            // Hay una relacion MUCHOS A MUCHOS, se agrtegan unos registros a las tabla intermedia
             $details = Detail::all();
             foreach($details as $detail){
                 $detail->categories()->attach($category->id);
             }

        }

    }
}
