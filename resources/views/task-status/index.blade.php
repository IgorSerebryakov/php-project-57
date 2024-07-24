@extends('layouts.app')

@section('content')
    <h1>Список статусов</h1>
    @foreach($taskStatuses as $status)
        <h2>{{ $status->name }}</h2>
        @auth
            <a href="{{ route('task_statuses.destroy', $status->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
        @endauth
    @endforeach
@endsection
