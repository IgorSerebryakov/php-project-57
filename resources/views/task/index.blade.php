@extends('layouts.app')

@section('content')
    <section class="bg-black dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-3 pt-20 pb-8 mx-auto lg:gap-8 lg:grid-cols-12 lg:pt-28 lg:py-16">
            <div class="grid col-span-full text-white">
                <p class="h1 mb-4">Задачи</p>
                <div class="w-full flex items-center">
                    {{ html()->modelForm($tasks, 'GET', route('tasks.index'))->open() }}
                    <div class="flex text-black">
                        {{ html()->select('filter[status_id]', ['' => 'Статус'] + $statuses, old('status_id')) }}
                        {{ html()->select('filter[created_by_id]', ['' => 'Автор'] + $creators) }}
                        {{ html()->select('filter[assigned_to_id]', ['' => 'Исполнитель'] + $assigners) }}
                        <div class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">
                            {{ html()->submit('Применить') }}
                            {{ html()->closeModelForm() }}
                        </div>
                    </div>
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
    </section>
    @dd(old($statuses[1]))
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
