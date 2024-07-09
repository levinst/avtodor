<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - Камчатуправтодор</title>
    @else
        <title>Управление автомобильных дорог Камчатского края</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    @vite([
            'resources/css/app.css',
            'resources/js/app.js',
        ])

    @livewireStyles


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ url(asset('css/animate.min.css')) }}" />
    <link rel="stylesheet" href="{{ url(asset('css/aos.css')) }}" />

    @stack('styles')
</head>

<body>

    @yield('body')

    <footer class="flex items-center text-gray-600 body-font min-h-[200px]">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a href="http://levinst.ru" title="Levin Studio - Разработка сайтов на Камчатке" class="flex title-font font-medium items-center lg:justify-start justify-center text-gray-900">
                <img class=" w-32" src="{{ url(asset('images/levinst.png')) }}"/>
            </a>
            <div class="text-gray-700 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-500 sm:py-2 sm:mt-0 mt-4 lg:whitespace-nowrap">
                <p class="font-bold">© 2023 -  Краевое государственное казенное учреждение “Управление автомобильных дорог Камчатского края”</p>
                <p class="text-sm">
                    {{ $contacts['address'] }}<br />
                    Телефоны: секретарь - {{ $contacts['tel1'] }}, диспетчер - {{ $contacts['tel2'] }}<br />
                    E-mail: {{ $contacts['email'] }}
                </p>
            </div>
        </div>
    </footer>

    <a href="#" id="toTop">
        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm.53 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v5.69a.75.75 0 001.5 0v-5.69l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd"></path>
        </svg>
    </a>

    @livewireScripts

    <script type="text/javascript" src="{{ url(asset('js/aos.js')) }}"></script>
    <script>
        AOS.init();
    </script>

    @stack('scripts')
</body>

</html>
