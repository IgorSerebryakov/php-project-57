<?php

namespace Database\Factories;

use App\Models\User;
use App\Modules\TaskStatus\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Task\Models\Task>
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
