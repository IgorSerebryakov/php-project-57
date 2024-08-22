<?php

namespace Database\Seeders;

use App\Modules\Label\Models\Label;
use App\Modules\Task\Models\Task;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::query()->truncate();

        $tasks = Yaml::parseFile(__DIR__ . '/../fixtures/tasks.yml');

        Task::factory()
            ->count(count($tasks))
            ->sequence(...$tasks)
            ->create()
            ->each(function (Task $task) {
                $labelIds = Label::query()->inRandomOrder()->take(3)->pluck('id');
                $task->labels()->attach($labelIds, [
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            });
    }
}
