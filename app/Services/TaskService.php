<?php

namespace App\Services;

use App\Repositories\LabelRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TaskStatusRepository;
use App\Repositories\UserRepository;

class TaskService
{
    public function __construct(
        public TaskRepository $taskRepository,
        public TaskStatusRepository $taskStatusRepository,
        public UserRepository $userRepository,
        public LabelRepository $labelRepository
    ) {}

    public function getSelectParams(string $entity): array
    {
        $mapping = [
            'statuses' =>
                fn() => $this->taskStatusRepository->getSelectParams(),
            'users' =>
                fn() => $this->userRepository->getSelectParams(),
            'labels' =>
                fn() => $this->labelRepository->getSelectParams()
        ];

        return $mapping[$entity]();
    }
}
