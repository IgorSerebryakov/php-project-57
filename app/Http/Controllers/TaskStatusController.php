<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::query()->paginate();
        return view('task-status.index', compact('taskStatuses'));
    }

    public function show($id)
    {
        $taskStatus = TaskStatus::query()->findOrFail($id);
        return view('task-status.show', compact('taskStatus'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();

        return view('task-status.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:task_statuses'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('task-statuses.index');
    }
}
