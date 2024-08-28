@extends('layouts.app')

@section('content')
    <section class="bg-black dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-8 lg:pt-28">
            <div class="grid col-span-full text-white">
                <p class="h2 mb-4">Просмотр задачи: {{ $task->name }}</p>
                <div>
                    <span>
                        Имя: {{ $task->name }}
                    </span>
                    <span>
                        Статус: {{ $task->status->name }}
                    </span>
                    <span>
                        Описание: {{ $task->description }}</span>
                    <>
                        @foreach ($task->labels as $label)
                            {{ $label->name }}
                        @endforeach
                </div>

                    @if ($errors->any())
                        <div class="text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
