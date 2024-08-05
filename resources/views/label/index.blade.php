@extends('layouts.app')

@section('content')
    @include('flash::message')
    <h1>Список меток</h1>
    @foreach($labels as $label)
        <h2>{{ $label->name }}</h2>
        @auth
            <a href="{{ route('labels.destroy', $label->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
            <a href="{{ route('labels.edit', $label->id) }}">Изменить</a>
        @endauth
    @endforeach
@endsection
