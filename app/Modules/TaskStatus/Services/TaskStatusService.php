<?php

namespace App\Modules\TaskStatus\Services;

use App\Modules\Task\Repositories\TaskRepository;
use App\Modules\TaskStatus\DTO\TaskStatusDTO;
use App\Modules\TaskStatus\Models\TaskStatus;
use App\Modules\TaskStatus\Repositories\TaskStatusRepository;

class TaskStatusService
{
    public function __construct(
        public TaskStatusRepository $taskStatusRepository,
        public TaskRepository $taskRepository,
    ) {}

    public function createOrUpdate(TaskStatusDTO $dto): TaskStatus
    {
        $status = $this->taskStatusRepository->getById($dto->id);

        if (empty($status)) {
            $status = new TaskStatus();
            flash(__('flash.task_status.create.success'))->success();
        } else {
            flash(__('flash.task_status.update.success'))->success();
        }

        $status->fill($dto->toArray());
        $status->save();

        return $status;
    }

    public function destroy(TaskStatus $status)
    {
        $allIds = $this->taskRepository->getAllIds();

        if (in_array($status->id, $allIds) ) {
            flash(__('flash.task_status.destroy.fail'))->error();
        } else {
            $status->delete();
            flash(__('flash.task_status.destroy.success'))->success();
        }
    }
}
