<?php

namespace App\Repositories;
use App\Models\Label;
use App\Services\SelectParamsProvider;

class LabelRepository implements SelectParamsProvider
{
    public function __construct(
        public Label $model
    ) {}

    public function getAll()
    {
        return $this->model->query()->paginate();
    }

    public function getById(?int $id)
    {
        return $this->model->query()->find($id);
    }

    public function getSelectParams()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->all();
    }
}
