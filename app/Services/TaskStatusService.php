<?php

namespace App\Services;

use App\DTO\TaskStatusDTO;
use App\Models\TaskStatus;
use App\Repositories\TaskRepository;
use App\Repositories\TaskStatusRepository;

class TaskStatusService
{
    public function __construct(
        public TaskStatusRepository $taskStatusRepository,
        public TaskRepository $taskRepository
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
