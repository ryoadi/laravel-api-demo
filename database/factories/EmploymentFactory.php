<?php

namespace Database\Factories;

use App\Enums\EmploymentStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employment>
 */
class EmploymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(EmploymentStatusEnum::cases())->value,
            'created_by_id' => User::factory(),
        ];
    }
}
