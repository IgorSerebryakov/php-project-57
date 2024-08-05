<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::query()->paginate();
        return view('label.index', compact('labels'));
    }

    public function show($id)
    {
        $label = Label::query()->findOrFail($id);
        return view('label.show', compact('label'));
    }

    public function create()
    {
        $label = new Label();
        return view('label.create', compact('label'));
    }

    public function store(LabelRequest $request)
    {
        $label = new Label();

        $label->fill($request->validated());
        $label->save();

        flash(__('flash.label.create.success'));

        return redirect(route('labels.index'));
    }

    public function edit($id)
    {
        $label = Label::query()->findOrFail($id);

        return view('label.edit', compact('label'));
    }

    public function update(LabelRequest $request, $id)
    {
        $label = Label::query()->findOrFail($id);

        $label->fill($request->validated());
        $label->save();

        flash(__('flash.label.update.success'));

        return redirect(route('labels.index'));
    }

    public function delete($id)
    {
        $label = Label::query()->findOrFail($id);

        $label->delete();
        flash(__('flash.label.destroy.success'));

        return redirect(route('labels.index'));
    }
}
