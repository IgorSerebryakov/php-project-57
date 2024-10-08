<?php

namespace App\Modules\TaskStatus\DTO;
use Spatie\LaravelData\Data;

class TaskStatusDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name
    ) {}
}
