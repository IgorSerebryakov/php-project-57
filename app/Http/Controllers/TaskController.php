<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->paginate();
        return view('task.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::query()->findOrFail($id);
        return view('task.show', compact('task'));
    }

    public function create()
    {
        $task = new Task();

        $statuses = $this->getSelectParams(new TaskStatus());
        $users = $this->getSelectParams(new User());

        return view('task.create', compact('task', 'statuses', 'users'));
    }

    public function store(TaskRequest $request)
    {
        $task = new Task();

        $task->fill($request->validated());
        $task->creator()->associate(Auth::user());
        $task->save();

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

        return view('task.edit', compact('task'));
    }

    public function update(TaskRequest $task, $id)
    {

    }
}
