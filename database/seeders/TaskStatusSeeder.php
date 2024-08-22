<?php

namespace Database\Seeders;

use App\Modules\TaskStatus\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::query()->truncate();

        TaskStatus::factory()->create(['name' => __('seeders.task_status.new')]);
        TaskStatus::factory()->create(['name' => __('seeders.task_status.at_work')]);
        TaskStatus::factory()->create(['name' => __('seeders.task_status.in_archive')]);
        TaskStatus::factory()->create(['name' => __('seeders.task_status.completed')]);
    }
}
