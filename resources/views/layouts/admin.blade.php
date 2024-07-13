<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Панель управления</title>

        <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        @vite([
                'resources/css/admin.css',
                'resources/css/app.css',
                'resources/js/app.js',
            ])

        {{-- for Datepicker --}}
        @if(
                Route::is('news') ||
                Route::is('files') ||
                Route::is('photoreports')
            )
            @vite([
                'resources/js/admin.js',
            ])
        @endif


        @livewireStyles
        @livewireScripts

        @stack('styles')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body>

        <!--Container -->
        <div class="mx-auto bg-grey-400">
            <!--Screen-->
            <div class="min-h-screen flex flex-col">
                <!--Header Section Starts Here-->
                <header class="bg-nav">
                    <div class="flex justify-between">
                        <div class="p-1 mx-3 inline-flex items-center">
                            <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                            <h1 class="text-white p-2">Камчатуправтодор</h1>
                        </div>
                        <div class="p-1 flex flex-row items-center mr-4">
                            @auth
                                <a class="text-gray-500" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Выход
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    </div>
                </header>
                <!--/Header-->

                <div class="flex flex-1">
                    <!--Sidebar-->
                    <aside id="sidebar" class="bg-side-nav w-1/6 border-r border-side-nav hidden md:block lg:block">

                        <ul class="list-reset flex flex-col">
                            <li class=" w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('administrator') ? 'bg-white' : '' }}">
                                <a href="{{ route('administrator') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Главная
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('news') ? 'bg-white' : '' }}">
                                <a href="{{ route('news') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Новости
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('photoreports') ? 'bg-white' : '' }}">
                                <a href="{{ route('photoreports') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Фотоотчеты
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('files') ? 'bg-white' : '' }}">
                                <a href="{{ route('files') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Файлы
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('faqs') ? 'bg-white' : '' }}">
                                <a href="{{ route('faqs') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Вопросы
                                    @hasSection('count_q')
                                        <span class="ml-4 px-2 w-10  text-white rounded-full bg-red-600">@yield('count_q')</span>
                                    @endif
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('categories') ? 'bg-white' : '' }}">
                                <a href="{{ route('categories') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Категории материалов
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('contents') ? 'bg-white' : '' }}">
                                <a href="{{ route('contents') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Материалы
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('info-carrier') ? 'bg-white' : '' }}">
                                <a href="{{ route('info-carrier') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Информация для перевозчиков
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('contr-cat-doc') ? 'bg-white' : '' }}">
                                <a href="{{ route('contr-cat-doc') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Категории документов весового контроля
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('contr-doc') ? 'bg-white' : '' }}">
                                <a href="{{ route('contr-doc') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Документы весового контроля
                                </a>
                            </li>
                            <li class="w-full h-full py-3 px-2 border-b border-light-border
                                {{ Route::is('banners') ? 'bg-white' : '' }}">
                                <a href="{{ route('banners') }}" class="block font-hairline hover:text-sky-800 font-normal text-sm text-nav-item no-underline w-full">
                                    Баннеры
                                </a>
                            </li>
                        </ul>

                    </aside>
                    <!--/Sidebar-->

                    <div class="w-full p-6">
                        @yield('content')
                    </div>

                </div>
                <!--Footer-->
                <footer class="bg-grey-darkest text-white p-2">
                    <div class="flex flex-1 mx-auto"><a href="https://levinst.ru">Levin Studio</a></div>
                </footer>
                <!--/footer-->

            </div>

            <a href="#" id="toTop">
                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm.53 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v5.69a.75.75 0 001.5 0v-5.69l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd"></path>
                </svg>
            </a>

        </div>

        <script src="{{ url(asset('plugins/tinymce/tinymce.min.js')) }}"></script>
        <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

        @stack('scripts')
    </body>

</html>
