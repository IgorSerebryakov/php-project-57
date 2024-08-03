<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Yaml\Yaml;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->text(20),
            'description' => fake()->text(),
            'status_id' => TaskStatus::query()->inRandomOrder()->first(),
            'created_by_id' => User::query()->inRandomOrder()->first(),
            'assigned_to_id' => User::query()->inRandomOrder()->first()
        ];
    }
}
