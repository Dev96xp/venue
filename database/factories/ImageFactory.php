<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //Genera imagenes falsas y las guarda en esta direcion
        return [
            'url' => 'products/' . $this->faker->image('storage/app/public/products', 640, 480, null, false),
        ];
    }

}
