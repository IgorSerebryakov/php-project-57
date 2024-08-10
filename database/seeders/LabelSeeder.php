<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::query()->truncate();

        $labels = Yaml::parseFile(__DIR__ . '/../fixtures/labels.yml');

        Label::factory()
            ->count(count($labels))
            ->sequence(...$labels)
            ->create();
    }
}
