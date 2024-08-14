<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Flash -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <!-- Page Heading -->
        <header class="fixed w-full">
            <nav class="bg-white border-gray-200 py-4 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    <a class="flex items-center" href="/">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                    </a>
                    <div class="items-center justify-between w-full lg:flex lg:w-auto lg:order-1">
                        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a class="block py-2 pt-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="/tasks">Задачи</a>
                            </li>
                            <li>
                                <a class="block py-2 pt-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="/task_statuses">Статусы</a>
                            </li>
                            <li>
                                <a class="block py-2 pt-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="/labels">Метки</a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center lg:order-2">
                        <a href="#"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Page Content -->
        @yield('content')
    </body>
</html>
