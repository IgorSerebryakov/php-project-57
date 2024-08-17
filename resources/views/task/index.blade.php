@extends('layouts.app')

@section('content')
    <div class="bg-black dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:pt-28 lg:py-16">
            <div class="text-gray-800 dark:text-white">
                <h1 class="mb-5 text-2xl font-bold">Задачи</h1>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
                <table class="table mt-4 w-full rounded-lg shadow-md dark:bg-gray-900">
                    <thead>
                    <tr>
                        @foreach (['ID', 'Статус', 'Имя', 'Автор', 'Исполнитель', 'Дата создания', 'Действия'] as $header)
                            <th class="border-b border-black p-2 text-left">{{ $header }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b dark:hover:bg-gray-700">
                            <td class="p-2">{{ $task->id }}</td>
                            <td class="p-2">{{ $task->status->name }}</td>
                            <td class="p-2">
                                <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a>
                            </td>
                            <td class="p-2">{{ $task->creator->name }}</td>
                            <td class="p-2">{{ $task->executor->name }}</td>
                            <td class="p-2">{{ $task->created_at->format('d.m.Y H:i') }}</td>
                            <td class="p-2">
                                <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <nav aria-label="Пример навигации по страницам">
                    <ul class="pagination">
                        {!! $tasks->withQueryString()->links('pagination::bootstrap-4') !!}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection



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
