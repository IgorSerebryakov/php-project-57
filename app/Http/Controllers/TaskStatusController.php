<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:task_statuses' // Заменить на общую валидацию
        ]);

        if ($validator->fails()) {
            dd($validator->errors()->keys());
        }

        $taskStatus = new TaskStatus();
        $taskStatus->fill($validator);

        $taskStatus->save();

        flash('Not welcome')->error();
        return redirect()->route('task_statuses.index');
    }

    public function edit($id)
    {
        $taskStatus = TaskStatus::query()->findorfail($id);

        return view('task-status.edit', compact('taskStatus'));
    }

    public function update(Request $request, $id)
    {
        $taskStatus = TaskStatus::query()->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id // Заменить на общую валидацию
        ]);

        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

    public function destroy($id)
    {
        $taskStatus = TaskStatus::query()->find($id);

        if ($taskStatus) {
            $taskStatus->delete();
        }

        return redirect()->route('task_statuses.index');
    }
}