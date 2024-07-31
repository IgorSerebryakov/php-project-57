@extends('layouts.app')

@section('content')
    {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
    {{ html()->label('Описание', 'description') }}
    {{ html()->input('textarea', 'description') }}
    {{ html()->select('status_id', $statuses) }}
    {{ html()->select('assigned_to_id', ['' => ''] + $users) }}
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
