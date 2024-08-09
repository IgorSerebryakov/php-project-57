<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use App\Repositories\TaskStatusRepository;
use App\Services\TaskStatusService;
use App\DTO\TaskStatusDTO;

class TaskStatusController extends Controller
{
    public function __construct(
        protected TaskStatusRepository $statusRepository,
        protected TaskStatusService $statusService
    ) {}

    public function index()
    {
        $statuses = $this->statusRepository->getAll();
        return view('task-status.index', compact('statuses'));
    }

    public function show($id)
    {
        $status = $this->statusRepository->getById($id);
        return view('task-status.show', compact('status'));
    }

    public function create()
    {
        return view('task-status.create', ['taskStatus' => new TaskStatus()]);
    }

    public function store(TaskStatusRequest $request)
    {
        $statusDTO = new TaskStatusDTO (
            id: null,
            name: $request->name
        );

        $this->statusService->createOrUpdate($statusDTO);

        return redirect()->route('task_statuses.index');
    }

    public function edit($id)
    {
        $status = TaskStatus::query()->findorfail($id);
        return view('task-status.edit', compact('status'));
    }

    public function update(TaskStatusRequest $request, $id)
    {
        $status = TaskStatus::query()->findOrFail($id);

        $status->fill($request->validated());
        $status->save();

        return redirect()->route('task_statuses.index');
    }

    public function destroy($id)
    {
        $status = $this->statusRepository->getById($id);

        $this->statusService->destroy($status);

        return redirect()->route('task_statuses.index');
    }
}
