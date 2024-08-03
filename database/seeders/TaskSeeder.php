<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->create();
    }
}
