<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence();
        $price = $this->faker->randomElement([69, 79, 89, 99, 1590, 1090]);
        return [
            'name'=>$name,
            'sku' => $this->faker->unique()->numberBetween($min=100000, $max=997887),
            'model' => $this->faker->unique()->numberBetween($min=100000, $max=997887),
            'style' => $this->faker->randomElement(['Renacentista','Victoriana', 'Princesa']),
            'name' =>  $this->faker->sentence(),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price' =>  $this->faker->randomElement([69, 79, 89, 99, 1590, 1090]),
            'suggestedprice' => $price * .8,
            'webprice' => $price * .8,
            'wholesaleprice' => 0,
            'sign' => 'sale50',
            'discount' =>$this->faker->randomElement([5,7,10,15,20]),
            'status'=> 3,

            'brand_id' => 1,
            'category_id' => 1,
            'subcategory_id' => 1,
            'status_product_id'=> 1
        ];
    }
}
