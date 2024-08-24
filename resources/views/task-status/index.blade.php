@extends('layouts.app')

@section('content')
    <section class="bg-black dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-3 pt-20 pb-8 mx-auto lg:gap-8 lg:grid-cols-12 lg:pt-28 lg:py-16">
            <div class="grid col-span-full text-white">
                <p class="h1 mb-4">Статусы</p>
                <div class="w-full flex">
                    <div class="ml-left">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded"
                           href="{{ route('task_statuses.create') }}">Создать статус</a>
                    </div>
                </div>
                <table class="mt-4">
                    <thead>
                    <tr>
                        @foreach (['ID', 'Имя', 'Дата создания', 'Действия'] as $header)
                            <th class="border-b border-black text-white">{{ $header }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statuses as $status)
                        <tr class="border-b border-dashed text-white">
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at->format('d.m.Y') }}</td>
                            <td>
                                <a class="text-red-600"
                                   href="{{ route('task_statuses.destroy', $status->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                                <a class="text-blue-600"
                                   href="{{ route('task_statuses.edit', $status->id) }}">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
