<?php

namespace App\Repositories;
use App\Models\Task;
use App\Services\SelectParamsProvider;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getLabelIdsById(?int $id)
    {
        return $this->getById($id)
            ->labels()
            ->pluck('label_id')
            ->toArray();
    }
}
