<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'date' => '2021-07-14',
            'phone' => $this->faker->phoneNumber,
            'status' => 'ACTIVE',
            'store_id' => Store::all()->random()->id,
            'code'=> $this->faker->randomElement(['PK1','PK2','PK3','PK4','PK5'])
        ];
    }
}
