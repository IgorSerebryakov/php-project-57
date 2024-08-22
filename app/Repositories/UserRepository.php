<?php

namespace App\Repositories;
use App\Models\User;
use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Task\Services\SelectParamsProvider;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function getAll()
    {
        return $this->model->query()
            ->paginate();
    }

    public function create()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->all();
    }

    public function getTasksCreators()
    {
        return $this->model->query()
            ->has('tasksCreated')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getTasksAssigners()
    {
        return $this->model->query()
            ->has('tasksAssigned')
            ->pluck('name', 'id')
            ->toArray();
    }
}
