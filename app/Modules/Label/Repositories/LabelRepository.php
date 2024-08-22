<?php

namespace App\Modules\Label\Repositories;
use App\Modules\Base\Repositories\BaseRepository;
use App\Modules\Label\Models\Label;
use App\Modules\Task\Services\SelectParamsProvider;

class LabelRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Label();
    }
}
