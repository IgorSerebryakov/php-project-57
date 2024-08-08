<?php

namespace App\Services;

use App\DTO\LabelDTO;
use App\Models\Label;
use App\Repositories\LabelRepository;

class LabelService
{
    public function __construct(
        public LabelRepository $repository
    ) {}

    public function createOrUpdate(LabelDTO $dto): Label
    {
        $label = LabelRepository::getById($dto->id);

        if (empty($label)) {
            $label = new Label();
            flash(__('flash.label.create.success'));
        } else {
            flash(__('flash.label.update.success'));
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
