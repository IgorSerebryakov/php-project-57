@extends('layouts.app')

@section('content')
    <section class="bg-black dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-3 pt-20 pb-8 mx-auto lg:gap-8 lg:grid-cols-12 lg:pt-28 lg:py-16">
            <div class="grid col-span-full text-white">
                <p class="h1 mb-4">Метки</p>
                <div class="w-full flex">
                    <div class="ml-left">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded"
                           href="{{ route('labels.create') }}">Создать метку</a>
                    </div>
                </div>
                <table class="mt-4">
                    <thead>
                    <tr>
                        @foreach (['ID', 'Имя', 'Описание', 'Дата создания', 'Действия'] as $header)
                            <th class="border-b border-black text-white">{{ $header }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($labels as $label)
                        <tr class="border-b border-dashed text-white">
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>
                            <td>
                                <a class="text-red-600"
                                   href="{{ route('labels.destroy', $label->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                                <a class="text-blue-600"
                                   href="{{ route('labels.edit', $label->id) }}">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

