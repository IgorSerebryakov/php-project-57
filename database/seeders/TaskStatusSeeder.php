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
        TaskStatus::factory()->create(['name' => 'новый']);
        TaskStatus::factory()->create(['name' => 'в работе']);
        TaskStatus::factory()->create(['name' => 'на тестировании']);
        TaskStatus::factory()->create(['name' => 'завершён']);
    }
}
