<?php

namespace App\Http\Controllers;

use App\Helpers\PageCounter;
use App\Http\Filters\Task\TaskFilterDTO;
use App\Http\Requests\TaskRequest;
use App\Modules\Label\Repositories\LabelRepository;
use App\Modules\Task\DTO\TaskDTO;
use App\Modules\Task\Models\Task;
use App\Modules\Task\Repositories\TaskRepository;
use App\Modules\Task\Services\TaskService;
use App\Modules\TaskStatus\Repositories\TaskStatusRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function __construct(
        protected TaskRepository $taskRepository,
        protected TaskService $taskService,
        protected UserRepository $userRepository,
        protected TaskStatusRepository $taskStatusRepository,
        protected LabelRepository $labelRepository
    ) {}

    public function index(Request $request)
    {
        $filter = new TaskFilterDTO(
            status_id: $request->get('filter')['status_id'] ?? null,
            created_by_id: $request->get('filter')['created_by_id'] ?? null,
            assigned_to_id: $request->get('filter')['assigned_to_id'] ?? null
        );

        $tasks = $this->taskRepository->getFiltered();

        $statuses = $this->taskStatusRepository->getTasksStatuses();
        $creators = $this->userRepository->getTasksCreators();
        $assigners = $this->userRepository->getTasksAssigners();


        $pageCounter = new PageCounter($tasks);


        return view('task.index', compact(
            'tasks',
            'statuses',
            'creators',
            'assigners',
            'filter',
            'pageCounter'
        ));
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
            'statuses' => $this->taskService->getSelectParams('statuses'),
            'users' => $this->taskService->getSelectParams('users'),
            'labels' => $this->taskService->getSelectParams('labels')
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

        $this->taskService->create($taskDTO);

        return redirect(route('tasks.index'));
    }

    public function edit($id)
    {
        return view('task.edit', [
            'task' => $this->taskRepository->getById($id),
            'statuses' => $this->taskStatusRepository->getNameIdPairs(),
            'users' => $this->userRepository->getNameIdPairs(),
            'labels' => $this->labelRepository->getNameIdPairs(),
            'taskLabels' => $this->taskRepository->getLabelIdsById($id)
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

        $this->taskService->update($taskDTO);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = $this->taskRepository->getById($id);

        $this->taskService->destroy($task);

        return redirect()->route('tasks.index');
    }
}
