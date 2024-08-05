@extends('layouts.app')

@section('content')
    {{ html()->modelForm($label, 'POST', route('labels.store'))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
    {{ html()->label('Описание', 'description') }}
    {{ html()->input('textarea', 'description') }}
    {{ html()->submit('Создать') }}
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
