@extends('layouts.app')

@section('content')
    <h1>Список задач</h1>
    @include('flash::message')
    @foreach($tasks as $task)
        <h2>{{ $task->name }}</h2>
        @auth
            <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
            @if ($task->creator->id === \Illuminate\Support\Facades\Auth::id())
                <a href="{{ route('tasks.destroy', $task->id) }}">Удалить</a>
            @endif
        @endauth
    @endforeach
@endsection
