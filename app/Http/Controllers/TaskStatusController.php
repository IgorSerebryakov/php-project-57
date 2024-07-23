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
}
