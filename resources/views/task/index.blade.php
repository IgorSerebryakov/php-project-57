@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:pt-28 lg-gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="text-white grid default:col-span-full">
                <h1 class="mb-5">Задачи</h1>
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-white text-left">
                        <tr>
                            <th class="p-1">ID</th>
                            <th class="p-1">Статус</th>
                            <th class="p-1">Имя</th>
                            <th class="p-1">Автор</th>
                            <th class="p-1">Исполнитель</th>
                            <th class="p-1">Дата создания</th>
                            <th class="p-1">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->status->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

{{--        <h1>Список задач</h1>--}}
{{--        @include('flash::message')--}}
{{--        @foreach($tasks as $task)--}}
{{--            <h2>{{ $task->name }}</h2>--}}
{{--            @auth--}}
{{--                <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>--}}
{{--                @if ($task->creator->id === \Illuminate\Support\Facades\Auth::id())--}}
{{--                    <a href="{{ route('tasks.destroy', $task->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        @endforeach--}}
    </section>
@endsection
