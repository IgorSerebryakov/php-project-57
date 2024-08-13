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
            <nav class="bg-white border-gray-200 py-2.5 dark:bg-black shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    <a class="flex items-center" href="https://php-task-manager-ru.onrender.com">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                    </a>
                    <a class="flex items-center lg:order-2">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
                           href="https://php-task-manager-ru.onrender.com/logout"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                    </a>
                </div>
            </nav>
        </header>

        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="text-center">
            @yield('content')
        </main>
    </body>
</html>
