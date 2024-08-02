@extends('layouts.app')

@section('content')
    <h1>Список задач</h1>
    @foreach($tasks as $task)
        <h2>{{ $task->name }}</h2>
        @auth
            <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
        @endauth
    @endforeach
@endsection
