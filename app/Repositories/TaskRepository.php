<?php

namespace App\Repositories;
use App\Models\Task;
use App\Models\User;
use App\Services\SelectParamsProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskRepository
{
    public function __construct(
        public Task $model,
        public UserRepository $userRepository
    ) {}

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
    public function getAllCreators()
    {
        $users = $this->userRepository->getAll()->items();

        $creators = array_filter ($users, function ($user) {
            return $user->tasksCreated()->count() > 0;
        });

        $result = [];
        foreach ($creators as $creator) {
            $result[$creator->id] = $creator->name;
        }

        return $result;
    }

    public function getAllAssigners()
    {
        $users = $this->userRepository->getAll()->items();

        $assigners = array_filter($users, function ($user) {
            return $user->tasksAssigned()->count() > 0;
        });

        $result = [];
        foreach ($assigners as $assigner) {
            $result[$assigner->id] = $assigner->name;
        }

        return $result;
    }
}
