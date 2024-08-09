<?php

namespace App\Repositories;
use App\Models\Label;

class LabelRepository
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
}
