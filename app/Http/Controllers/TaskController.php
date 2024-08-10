<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use App\Repositories\LabelRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TaskStatusRepository;
use App\Repositories\UserRepository;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


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

    public function update(TaskRequest $request, $id)
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

        if ($task->creator()->is(Auth::user())) {
            $task->delete();
            flash(__('flash.task.destroy.success'))->success();
        } else {
            flash(__('flash.task.destroy.fail'))->error();
        }

        return redirect()->route('tasks.index');
    }
}
