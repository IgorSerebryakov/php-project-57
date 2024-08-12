<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Database\Seeders\TaskSeeder;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private Task $task;
    private Task $newTask;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            TaskStatusSeeder::class,
            UserSeeder::class,
            TaskSeeder::class
        ]);

        $this->newTask = Task::factory()->make();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->create(['created_by_id' => $this->user]);
    }

    public function testCreateNotAllowedForGuest(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(403);
    }

    public function testUpdateNotAllowedForGuest(): void
    {
        $response = $this->patch(route('tasks.update', $this->task->id), $this->newTask->toArray());
        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $newTaskArray = array_filter($this->newTask->toArray(), function ($key) {
            return $key != 'created_by_id';
        }, ARRAY_FILTER_USE_KEY);
        dd($this->task);
        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', $this->task->id), $newTaskArray);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $newTaskArray);
    }

    public function testNotDestroyForNotCreator()
    {
        $newUser = User::factory()->create();
        $this->actingAs($newUser)->delete(route('tasks.destroy', $this->task->id));
        $this->assertDatabaseHas('tasks', $this->task->toArray());
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task->id));
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
        $this->assertFlashMessage(__('flash.task.destroy.success'));
    }

    protected function assertFlashMessage($expectedMessage)
    {
        $flashMessage = session('flash_notification')[0]['message'];
        $this->assertEquals($expectedMessage, $flashMessage);
    }
}
