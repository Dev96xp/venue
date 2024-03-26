<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->sentence(),
            'model' => $this->faker->unique()->numberBetween($min=100000, $max=997887),
            'price' =>  $this->faker->randomElement([69, 79, 89, 99, 1590, 1090]),
            'description' => $this->faker->paragraph(),
        ];
    }
}
