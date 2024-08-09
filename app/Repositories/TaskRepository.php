<?php

namespace App\Repositories;


use App\Models\Task;

class TaskRepository
{
    public function __construct(
        public Task $model
    ) {}


    public function getAllIds()
    {
        return $this->model->query()
            ->pluck('status_id')
            ->all();
    }
}
