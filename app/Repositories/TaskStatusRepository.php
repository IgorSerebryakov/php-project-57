<?php

namespace App\Repositories;

use App\Models\TaskStatus;
use Database\Seeders\TaskStatusSeeder;

class TaskStatusRepository
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
}
