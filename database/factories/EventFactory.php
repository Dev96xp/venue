<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::all()->random();

        return [
            'name' => $this->faker->name,
            'date' => $this->faker->date('Y-m-d', 'now'),
            'phone' => $this->faker->phoneNumber,
            'status' => 'ACTIVE',
            'store_id' => Store::all()->random()->id,
            'cus_id' => $user->cus_id,
            'user_id' => $user->id,
            //'package_id' => package::all()->random()->id,
            'code' => $this->faker->unique()->numberBetween($min = 100000, $max = 997887),
            'aux1' => 'open',
            'aux2' => 'open',
            'aux3' => 'open',
            'aux4' => 'open',
            'description' => ''
        ];
    }
}
