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
                    <a class="navbar-brand" href="#">Панель навигации</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                            aria-expanded="false" aria-label="Переключатель навигации">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="#">Главная</a>
                            <a class="nav-link" href="#">Рекомендуемые</a>
                            <a class="nav-link" href="#">Цена</a>
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Отключенная</a>
                        </div>
                    </div>
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
