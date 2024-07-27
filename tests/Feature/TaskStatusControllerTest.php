<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laracasts\Flash\FlashNotifier;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    public function testDestroyCanDeleteTaskStatus(): void
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
}
