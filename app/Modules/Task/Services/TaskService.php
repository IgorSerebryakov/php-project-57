<?php

namespace App\Modules\Task\Services;

use App\Modules\Base\Services\PageCounterService;
use App\Modules\Label\Repositories\LabelRepository;
use App\Modules\Task\DTO\TaskDTO;
use App\Modules\Task\Models\Task;
use App\Modules\Task\Repositories\TaskRepository;
use App\Modules\TaskStatus\Repositories\TaskStatusRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function __construct(
        public TaskRepository $taskRepository,
        public TaskStatusRepository $taskStatusRepository,
        public UserRepository $userRepository,
        public LabelRepository $labelRepository,
    ) {}

    public function create(TaskDTO $dto): void
    {
        $task = new Task();
        $task->fill($dto->toArray());
        $task->creator()->associate(Auth::user());
        $task->save();
        $task->labels()->attach($dto->label_id, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        flash(__('flash.task.create.success'));
    }

    public function update(TaskDTO $dto): void
    {
        $task = $this->taskRepository->getById($dto->id);
        $task->fill($dto->toArray());
        $task->save();

        flash(__('flash.task.update.success'));
    }

    public function destroy(Task $task): void
    {
        if ($task->creator()->is(Auth::user())) {
            $task->delete();
            flash(__('flash.task.destroy.success'))->success();
        } else {
            flash(__('flash.task.destroy.fail'))->error();
        }
    }

    public function getSelectParams(string $entity): array
    {
        $mapping = [
            'statuses' =>
                fn() => $this->taskStatusRepository->getNameIdPairs(),
            'users' =>
                fn() => $this->userRepository->getNameIdPairs(),
            'labels' =>
                fn() => $this->labelRepository->getNameIdPairs()
        ];

        return $mapping[$entity]();
    }
}
