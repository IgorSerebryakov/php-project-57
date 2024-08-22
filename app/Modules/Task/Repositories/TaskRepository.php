<?php

namespace App\Modules\Task\Repositories;
use App\Models\User;
use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Task\Models\Task;
use App\Repositories\UserRepository;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Task();
    }

    public function getAllIds()
    {
        return $this->model->query()
            ->pluck('status_id')
            ->all();
    }

    public function getLabelIdsById(?int $id)
    {
        return $this->getById($id)
            ->labels()
            ->pluck('label_id')
            ->toArray();
    }

    public function getAllWithFilter()
    {
        return QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            ])
            ->paginate();
    }
}
