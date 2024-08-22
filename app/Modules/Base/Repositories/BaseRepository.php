<?php

namespace App\Modules\Base\Repositories;

class BaseRepository
{
    protected $model;

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

    public function getNameIdPairs()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->all();
    }
}
