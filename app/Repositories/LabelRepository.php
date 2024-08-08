<?php

namespace App\Repositories;
use App\Models\Label;

class LabelRepository
{
    public static function getAll()
    {
        return Label::query()->paginate();
    }

    public static function getById(?int $id)
    {
        return Label::query()->find($id);
    }
}
