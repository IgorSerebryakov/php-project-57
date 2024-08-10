<?php

namespace App\Repositories;

use App\Models\TaskStatus;
use App\Services\SelectParamsProvider;
use Database\Seeders\TaskStatusSeeder;

class TaskStatusRepository implements SelectParamsProvider
{
    public function __construct(
        public TaskStatus $model
    )
    {}

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

    public function getSelectParams()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->all();
    }
}
