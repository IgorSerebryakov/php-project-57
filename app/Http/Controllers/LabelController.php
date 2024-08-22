<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Modules\Label\DTO\LabelDTO;
use App\Modules\Label\Models\Label;
use App\Modules\Label\Repositories\LabelRepository;
use App\Modules\Label\Services\LabelService;

class LabelController extends Controller
{
    public function __construct(
        protected LabelRepository $repository,
        protected LabelService $service
    ) {}

    public function index()
    {
        $labels = $this->repository->getAll();
        return view('label.index', compact('labels'));
    }

    public function show($id)
    {
        $label = $this->repository->getById($id);
        return view('label.show', compact('label'));
    }

    public function create()
    {
        return view('label.create', ['label' => new Label()]);
    }

    public function store(LabelRequest $request)
    {
        $labelDTO = new LabelDTO(
            id: null,
            name: $request->name,
            description: $request->description
        );

        $this->service->createOrUpdate($labelDTO);
        return redirect(route('labels.index'));
    }

    public function edit($id)
    {
        $label = $this->repository->getById($id);
        return view('label.edit', compact('label'));
    }


    public function update(LabelRequest $request)
    {
        $labelDTO = new LabelDTO(
            id: $request->id,
            name: $request->name,
            description: $request->description
        );

        $this->service->createOrUpdate($labelDTO);
        return redirect(route('labels.index'));
    }

    public function destroy($id)
    {
        $label = $this->repository->getById($id);
        $this->service->destroy($label);
        return redirect(route('labels.index'));
    }
}
