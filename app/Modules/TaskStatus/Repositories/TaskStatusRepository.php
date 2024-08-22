<?php

namespace App\Modules\TaskStatus\Repositories;

use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Task\Models\Task;
use App\Modules\TaskStatus\Models\TaskStatus;

class TaskStatusRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new TaskStatus();
    }

    public function getTasksStatuses()
    {
        return $this->model->query()
            ->has('tasks')
            ->pluck('name', 'id')
            ->toArray();
    }
}
