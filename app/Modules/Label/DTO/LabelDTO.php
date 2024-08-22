<?php

namespace App\Modules\Label\DTO;

use Spatie\LaravelData\Data;

class LabelDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $description
    ) {}
}
