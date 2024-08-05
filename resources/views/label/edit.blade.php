@extends('layouts.app')

@section('content')
    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label->id))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name', $label->name) }}
    {{ html()->label('Описание', 'description') }}
    {{ html()->input('textarea', 'description', $label->description) }}
    {{ html()->submit('Изменить') }}
    {{ html()->closeModelForm() }}
    @if ($errors->any())
        <div class="text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
