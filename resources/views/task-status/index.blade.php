@extends('layouts.app')

@section('content')
    @include('flash::message')
    <h1>Список статусов</h1>
    @foreach($statuses as $status)
        <h2>{{ $status->name }}</h2>
        @auth
            <a href="{{ route('task_statuses.destroy', $status->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
            <a href="{{ route('task_statuses.edit', $status->id) }}">Изменить</a>
        @endauth
    @endforeach
@endsection
