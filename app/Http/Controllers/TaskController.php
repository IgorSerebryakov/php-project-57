<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
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
        dd($taskStatuses = DB::table('task_statuses')->get());

        return view('task.create', compact('task', 'taskStatuses'));
    }

    public function store(Request $request, TaskStatus $status, User $creator)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks|max:255',
            'description' => 'max:255',
            'status_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        dd($task = $creator->tasksCreated()->make());
    }
}
