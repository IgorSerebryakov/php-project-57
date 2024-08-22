<?php

namespace App\DTO;

use Spatie\LaravelData\Data;


class TaskFilterDTO extends Data
{
    public function __construct(
        public ?int $status_id,
        public ?int $created_by_id,
        public ?int $assigned_to_id,
    ) {}
}
