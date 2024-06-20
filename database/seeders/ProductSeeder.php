<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Product::create([
        //     'sku' => 'DA43567',
        //     'model' => 43567,
        //     'style' => 'Renacentista',
        //     'name' => 'Esmeralda Invitation',
        //     'slug' => 'esmeralda-invitacion',
        //     'description' => 'Es la parte mas alta de la invitacion',
        //     'price' => 1.99,
        //     'suggestedprice' => 20.00,
        //     'webprice' => 25.00,
        //     'wholesaleprice' => 18.00,
        //     'sign' => 'sale50',
        //     'discount' => 5,
        //     'status'=> 3,
        //     'brand_id' => 1,
        //     'category_id' => 1,
        //     'subcategory_id' => 1,
        //     'status_product_id'=> 1
        // ]);

        // Product::create([
        //     'sku' => 'DA42401',
        //     'model' => 42401,
        //     'style' => 'Renacentista',
        //     'name' => 'Diamante Invitation',
        //     'slug' => 'diamante-invitacion',
        //     'description' => 'Es la parte mas alta de la invitacion',
        //     'price' => 2.99,
        //     'suggestedprice' => 20.00,
        //     'webprice' => 25.00,
        //     'wholesaleprice' => 18.00,
        //     'sign' => 'sale50',
        //     'discount' => 5,
        //     'brand_id' => 1,
        //     'category_id' => 1,
        //     'subcategory_id' => 1,
        //     'status_product_id'=> 1
        // ]);

        // Product::create([
        //     'sku' => 'DA42500',
        //     'model' => 42500,
        //     'style' => 'Renacentista',
        //     'name' => 'Gema Invitation',
        //     'slug' => 'gema-invitacion',
        //     'description' => 'Es la parte mas alta de la invitacion',
        //     'price' => 3.99,
        //     'suggestedprice' => 20.00,
        //     'webprice' => 25.00,
        //     'wholesaleprice' => 18.00,
        //     'sign' => 'sale50',
        //     'discount' => 5,
        //     'brand_id' => 1,
        //     'category_id' => 1,
        //     'subcategory_id' => 1,
        //     'status_product_id'=> 1
        // ]);





        // Genera 100 registros de prueba y los asigna al mismo tiempo a una variable
        Product::factory(2)->create();

        $products = Product::all();
        //Se usa la variable para recorrer los registros delos productos
        // y asi generar, los id para las imagenes de estos cursos
        foreach ($products as $product) {

            // (Image) osea ImageFactory - CREA LAS IMAGENES PARA PRODUCTOS
            // crea 4 imagenes pro producto
            Image::factory(1)->create([
                'model' => $product->model,
                'imageable_id' => $product->id,
                'imageable_type' => 'App\Models\Product'
            ]);

        }

    }
}
