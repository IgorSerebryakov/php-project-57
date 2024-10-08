<?php

namespace App\Modules\Label\Services;

use App\Modules\Label\DTO\LabelDTO;
use App\Modules\Label\Models\Label;
use App\Modules\Label\Repositories\LabelRepository;

class LabelService
{
    public function __construct(
        public LabelRepository $repository
    ) {}

    public function createOrUpdate(LabelDTO $dto): Label
    {
        $label = $this->repository->getById($dto->id);

        if (empty($label)) {
            $label = new Label();
            flash(__('flash.label.create.success'))->success();
        } else {
            flash(__('flash.label.update.success'))->success();
        }

        $label->fill($dto->toArray());
        $label->save();

        return $label;
    }

    public function destroy(Label $label)
    {
        if ($label->tasks->isEmpty()) {
            $label->delete();
            flash(__('flash.label.destroy.success'));
        } else {
            flash(__('flash.label.destroy.fail'));
        }
    }
}
