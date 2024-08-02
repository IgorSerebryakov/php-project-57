@extends('layouts.app')

@section('content')
    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task->id))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name', $task->name) }}
    {{ html()->label('Описание', 'description') }}
    {{ html()->input('textarea', 'description', $task->description) }}
    {{ html()->select('status_id', $statuses, $task->status_id) }}
    {{ html()->select('assigned_to_id', ['' => ''] + $users, $task->assignet_to_id) }}
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
