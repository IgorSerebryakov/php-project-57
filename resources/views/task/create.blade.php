@extends('layouts.app')

@section('content')
    <section class="bg-black dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-8 lg:pt-28">
            <div class="grid col-span-full text-white">
                <p class="h1 mb-4">Создать задачу</p>
                <div>
                    {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
                    <div class="flex flex-col">
                        <div>
                            {{ html()->label('Имя', 'name') }}
                        </div>
                        <div class="mt-2 mb-2">
                            {{ html()->input('text', 'name')->class('rounded border-gray-300 w-1/3 text-black') }}
                        </div>
                        <div>
                            {{ html()->label('Описание', 'description') }}
                        </div>
                        <div class="mt-2 mb-2">
                            {{ html()->textarea('description')->class('rounded border-gray-300 w-1/3 h-32 text-black') }}
                        </div>
                        {{ html()->select('status_id', $statuses) }}
                        {{ html()->select('assigned_to_id', ['' => ''] + $users) }}
                        @foreach ($labels as $id => $label)
                            {{ html()->checkbox('label_id[]', false, $id) }}
                            {{ $label }}
                        @endforeach
                        {{ html()->submit('Создать') }}
                        {{ html()->closeModelForm() }}
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
        </div>
    </section>
@endsection

