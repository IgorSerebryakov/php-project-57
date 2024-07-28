<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Database\Seeders\TaskStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\FlashNotifier;
use Tests\TestCase;

// Создать БД для тестирования

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testDeleteRandomTaskStatus(): void
    {
        $taskStatus = TaskStatus::query()->create([
            'name' => fake()->name()
        ]);
        $response = $this->delete(route('task_statuses.destroy', $taskStatus->id));
        $response->assertRedirect(route('task_statuses.index'));
        $flashMessage = session('flash_notification')[0]['message'];
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
        $this->assertEquals($flashMessage, __('flash.task_status.destroy.success'));
    }

    public function testDeleteInitialTaskStatuses(): void
    {
        $this->seed([TaskStatusSeeder::class]);
        $this->assertDatabaseCount('task_statuses', 4);
        DB::table('task_statuses')
            ->whereIn('name', [
                __('seeders.task_status.new'),
                __('seeders.task_status.at_work'),
                __('seeders.task_status.in_archive'),
                __('seeders.task_status.completed')
            ])
            ->get()
            ->each(function ($taskStatus) {
                $response = $this->delete(route('task_statuses.destroy', $taskStatus->id));
                $response->assertRedirect(route('task_statuses.index'));
                $flashMessage = session('flash_notification')[0]['message'];
                $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
                $this->assertEquals($flashMessage, __('flash.task_status.destroy.fail'));
            });
    }

    public function ()
    {

    }
}
