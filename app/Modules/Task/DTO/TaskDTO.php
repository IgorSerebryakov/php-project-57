<?php

namespace App\Modules\Task\DTO;
use Spatie\LaravelData\Data;

class TaskDTO extends Data
{
    public function __construct(
        public ?int    $id,
        public string  $name,
        public ?string $description,
        public int     $status_id,
        public ?int    $assigned_to_id,
        public array   $label_id
    ) {}
}

