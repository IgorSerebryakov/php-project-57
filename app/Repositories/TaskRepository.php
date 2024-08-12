<?php

namespace App\Repositories;
use App\Models\Task;
use App\Services\SelectParamsProvider;

class TaskRepository
{
    public function __construct(
        public Task $model
    ) {}

    public function getAll()
    {
        return $this->model->query()
            ->paginate();
    }

    public function getById(?int $id)
    {
        return $this->model->query()
            ->find($id);
    }

    public function getAllIds()
    {
        return $this->model->query()
            ->pluck('status_id')
            ->all();
    }

    public function getLabelIdsById(?int $id): array
    {
        return $this->getById($id)
            ->labels()
            ->where('task_id', $id)
            ->pluck('label_id')
            ->toArray();
    }
}
