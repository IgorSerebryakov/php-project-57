<?php

namespace App\Repositories;

use App\Models\TaskStatus;
use Database\Seeders\TaskStatusSeeder;

class TaskStatusRepository
{
    protected TaskStatus $model;

    public function __construct()
    {
        $this->model = new TaskStatus();
    }
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
