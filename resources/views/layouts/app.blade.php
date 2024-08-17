<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Flash -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <!-- Page Heading -->
        <header class="fixed w-full">
            <nav class="bg-black border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-3 mx-auto">
                    <a class="flex items-center" href="/">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                    </a>
                    <div class="flex items-center lg:order-2">
                        <a href="#"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                        <ul class="flex flex-col font-medium lg:flex-row lg:space-x-8 lg:mt-0 mr-2">
                            <li>
                                <a class="block text-gray-700 hover:text-blue-700 lg:p-0" href="/tasks">Задачи</a>
                            </li>
                            <li>
                                <a class="block text-gray-700 hover:text-blue-700 lg:p-0" href="/task_statuses">Статусы</a>
                            </li>
                            <li>
                                <a class="block text-gray-700 hover:text-blue-700 lg:p-0" href="/labels">Метки</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Page Content -->
        @yield('content')
    </body>
</html>
