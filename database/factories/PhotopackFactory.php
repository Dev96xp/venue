<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photopack>
 */
class PhotopackFactory extends Factory
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
            'title' => $this->faker->randomElement(['QUINCE', 'BODA', 'EVENTO ESPECIAL', 'CONFERENCIA', 'CONCIERTO']),
            'status' => 'ACTIVE',
            'store_id' => Store::all()->random()->id,
            'user_id' => $user->id,
            // 'package_id' => Package::all()->random()->id,
            'code' => $this->faker->unique()->numberBetween($min = 100000, $max = 997887),
            'aux1' => 'open',
            'aux2' => 'open',
            'aux3' => 'open',
            'aux4' => 'open',
            'description' => '',
            'note' => ''
        ];
    }
}
