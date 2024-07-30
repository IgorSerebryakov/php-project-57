<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
