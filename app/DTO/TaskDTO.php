<?php

namespace App\DTO;
use Spatie\LaravelData\Data;

class TaskDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description,
        public int $statusId,
        public int $createdById,
        public ?int $assignedToId
    ) {}
}
