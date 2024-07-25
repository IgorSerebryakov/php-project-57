@extends('layouts.app')

@section('content')
    @include('flash::message')
    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->open() }}
    {{ html()->label('Имя', 'name') }}
    {{ html()->input('text', 'name') }}
    {{ html()->submit('Создать') }}
    {{ html()->closeModelForm() }}
@endsection
