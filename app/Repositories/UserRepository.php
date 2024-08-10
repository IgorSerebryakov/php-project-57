<?php

namespace App\Repositories;
use App\Models\User;
use App\Services\SelectParamsProvider;

class UserRepository implements SelectParamsProvider
{
    public function __construct(
        public User $model
    ) {}

    public function create()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->all();
    }

    public function getSelectParams()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->all();
    }
}
