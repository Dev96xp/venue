<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'role' => $this->faker->jobTitle(),
            'salary' => $this->faker->randomFloat(2, 10, 5000),
            'salary_period' => $this->faker->randomElement(Employee::SALARY_PERIODS),
            'status' => Employee::STATUS_ACTIVE,
        ];
    }
}
