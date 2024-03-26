<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Si funciona - Crea una solo imagen por subcategoria para pruebas, OJO !!! PERO NOLAS REGISTRA - Cambia esta linea si es necesario
            // para evitar acumulacion de imagenes, o solo comentala
            'image' => 'subcategories/' . $this->faker->image('storage/app/public/subcategories', 640, 480, null, false),
            'status'=>$this->faker->randomElement([Subcategory::ACTIVE, Subcategory::INACTIVE, Subcategory::PENDING]),
        ];
    }
}
