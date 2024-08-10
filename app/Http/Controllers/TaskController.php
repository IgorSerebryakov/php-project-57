<?php

namespace App\Http\Controllers;

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
        $task = new Task();

        $task->fill($request->validated());
        $task->creator()->associate(Auth::user());
        $task->save();

        $labelIds = $request->input('label_id');
        $task->labels()->attach($labelIds, ['created_at' => now(), 'updated_at' => now()]);

        flash(__('flash.task.create.success'));

        return redirect(route('tasks.index'));
    }

    private function getSelectParams(Model $model): array
    {
        return DB::table($model->getTable())->pluck('name', 'id')->all();
    }

    public function edit($id)
    {
        $task = Task::query()->findOrFail($id);

        $statuses = $this->getSelectParams(new TaskStatus());
        $users = $this->getSelectParams(new User());

        return view('task.edit', compact('task', 'statuses', 'users'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::query()->findOrFail($id);

        $task->fill($request->validated());
        $task->save();

        flash(__('flash.task.update.success'));

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
