<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;


class TaskController extends Controller
{
    public function __construct(
        protected TaskRepository $taskRepository,
        protected TaskService $service
    ) {}

    public function index()
    {
        $tasks = $this->taskRepository->getAll();
        return view('task.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = $this->taskRepository->getById($id);
        return view('task.show', compact('task'));
    }

    public function create()
    {
        return view('task.create', [
            'task' => new Task(),
            'statuses' => $this->service->getSelectParams('statuses'),
            'users' => $this->service->getSelectParams('users'),
            'labels' => $this->service->getSelectParams('labels')
        ]);
    }

    public function store(TaskRequest $request)
    {
        $taskDTO = new TaskDTO (
            id: null,
            name: $request->name,
            description: $request->description,
            status_id: $request->status_id,
            assigned_to_id: $request->assigned_to_id,
            label_id: $request->label_id
        );

        $this->service->create($taskDTO);

        return redirect(route('tasks.index'));
    }

    public function edit($id)
    {
        return view('task.edit', [
            'task' => $this->taskRepository->getById($id),
            'statuses' => $this->service->getSelectParams('statuses'),
            'users' => $this->service->getSelectParams('users')
        ]);
    }

    public function update(TaskRequest $request)
    {
        $taskDTO = new TaskDTO (
            id: $request->id,
            name: $request->name,
            description: $request->description,
            status_id: $request->status_id,
            assigned_to_id: $request->assigned_to_id,
            label_id: $request->label_id
        );

        $this->service->update($taskDTO);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::query()->findOrFail($id);

        $this->service->destroy($task);

        return redirect()->route('tasks.index');
    }
}
