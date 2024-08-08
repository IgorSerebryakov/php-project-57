<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class LabelDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $description
    ) {}
}
