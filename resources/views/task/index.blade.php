@extends('layouts.app')

@section('content')
    <section class="bg-black dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-3 pt-20 pb-8 mx-auto lg:gap-8 lg:grid-cols-12 lg:pt-28 lg:py-16">
            <div class="grid col-span-full text-white">
                <p class="h1 mb-4">Задачи</p>
                <div class="w-full flex items-center">
                    {{ html()->modelForm($tasks, 'GET', route('tasks.index'))->open() }}
                    <div class="flex text-black">
                        {{ html()->select('filter[status_id]', ['' => 'Статус'] + $statuses, $filter->status_id) }}
                        {{ html()->select('filter[created_by_id]', ['' => 'Автор'] + $creators, $filter->created_by_id) }}
                        {{ html()->select('filter[assigned_to_id]', ['' => 'Исполнитель'] + $assigners, $filter->assigned_to_id) }}
                        <div class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded ml-3">
                            {{ html()->submit('Применить') }}
                        </div>
                    </div>
                    {{ html()->closeModelForm() }}
                    <div class="ml-auto">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded"
                           href="{{ route('tasks.create') }}">Создать задачу</a>
                    </div>
                </div>
                <table class="mt-4">
                    <thead>
                    <tr>
                        @foreach (['ID', 'Статус', 'Имя', 'Автор', 'Исполнитель', 'Дата создания', 'Действия'] as $header)
                            <th class="border-b border-black text-white">{{ $header }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b border-dashed text-white">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->status->name }}</td>
                            <td>
                                <a class="text-blue-600"
                                   href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a>
                            </td>
                            <td>{{ $task->creator->name }}</td>
                            <td>{{ $task->executor->name }}</td>
                            <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <a class="text-blue-600" href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="w-full flex items-center justify-between mt-4" role="navigation"
                     aria-label="Pagination Navigation">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <p class="tex-sm text-gray-700 leading-5 dark:text-gray-400">
                            Showing
                            <span class="font-medium">{{ $pageCounter->getLeftBorder() }}</span>
                            to
                            <span class="font-medium">{{ $pageCounter->getRightBorder() }}</span>
                            of
                            <span class="font-medium">{{ $pageCounter->getTotal() }}</span>
                            Results
                        </p>
                        <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                            {!! $tasks->withQueryString()->links('pagination::bootstrap-4') !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
