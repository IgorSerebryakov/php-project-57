<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $task = Task::query()->paginate();
        return view('task.index', compact('task'));
    }

    public function show($id)
    {
        $task = Task::query()->findOrFail($id);
        return view('task.show', compact('task'));
    }

    public function create()
    {
        $task = new Task();
        return view('task.create', compact('task'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks|max:255',
            'description' => 'max:255',
            'status_id' => 'required'
        ]);

        if ($validator->fails()) {

        }
    }
}
