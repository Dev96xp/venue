<?php

namespace Database\Factories;

use App\Models\Photopack;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photoshot>
 */
class PhotoshotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::all()->random();
        return [
            'name' => $this->faker->name,
            'date' => $this->faker->date('Y-m-d', 'now'),
            'scheduled_at' => $this->faker->dateTimeBetween('now', '2 years'),
            'phone' => $this->faker->phoneNumber,
            'title' => $this->faker->randomElement(['STUDIO', 'QUINCE', 'WEDDING', 'COMPROMISO', 'CONFERENCIA', 'CONCIERTO', 'FAMILY','SENIOR']),
            'status' => $this->faker->randomElement(['SCHE', 'DONE', 'CANC']),
            'store_id' => Store::all()->random()->id,
            'cus_id' => $user->cus_id,
            'user_id' => $user->id,
            // 'package_id' => Package::all()->random()->id,
            'code' => $this->faker->unique()->numberBetween($min = 100000, $max = 997887),
            'aux1' => 'open',
            'aux2' => 'open',
            'aux3' => 'open',
            'aux4' => 'open',
            'description' => '',
            'note' => '',
            'photopack_id' => Photopack::all()->random()->id,
        ];
    }
}
