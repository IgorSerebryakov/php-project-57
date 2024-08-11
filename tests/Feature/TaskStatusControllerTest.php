<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Task;
use Database\Factories\TaskFactory;
use Database\Seeders\TaskSeeder;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\FlashNotifier;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private TaskStatus $taskStatus;
    private TaskStatus $newTaskStatus;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskStatus = TaskStatus::factory()->create();
        $this->newTaskStatus = TaskStatus::factory()->make();
        $this->user = User::factory()->create();
    }

    public function testCreateNotAllowedForGuest()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(403);
    }

    public function testUpdateNotAllowedForGuest()
    {
        $response = $this->patch(route('task_statuses.update', $this->taskStatus->id), $this->newTaskStatus->toArray());
        $this->assertDatabaseHas('task_statuses', $this->taskStatus->toArray());
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $response = $this->actingAs($this->user)
            ->patch(route('task_statuses.update', $this->taskStatus->id), $this->newTaskStatus->toArray());
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $this->newTaskStatus->toArray());
    }

    public function testNotDestroy(): void
    {
        $task = Task::factory()->create();
        $this->assertEquals($this->taskStatus->id, $task->status_id);
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus->id));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $this->assertFlashMessage(__('flash.task_status.destroy.fail'));
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus->id));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
        $this->assertFlashMessage(__('flash.task_status.destroy.success'));
    }

    protected function assertFlashMessage($expectedMessage)
    {
        $flashMessage = session('flash_notification')[0]['message'];
        $this->assertEquals($expectedMessage, $flashMessage);
    }
}
