<header class="fixed w-full">

    <nav class="bg-black border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-3 mx-auto">

            <a class="flex items-center" href="/">
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('main.title') }}</span>
            </a>

            @auth

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

            @else

                <div class="flex items-center lg:order-2">
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded mr-2"
                       href="{{ route('login') }}"> Вход </a>


                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded"
                       href="{{ route('register') }}"> Регистрация </a>
                </div>

            @endauth

                <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">

                    <ul class="flex flex-col font-medium lg:flex-row lg:space-x-8 lg:mt-0 mr-2">
                        <li>
                            <a class="block text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('tasks.index') }}"> Задачи </a>
                        </li>
                        <li>
                            <a class="block text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('task_statuses.index') }}"> Статусы </a>
                        </li>
                        <li>
                            <a class="block text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('labels.index') }}"> Метки </a>
                        </li>
                    </ul>

                </div>
        </div>
    </nav>
</header>
