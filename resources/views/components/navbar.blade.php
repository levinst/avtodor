<div class="w-full text-white bg-yellow-400 py-1 lg:py-4 mx-auto">
    <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto lg:items-center lg:justify-between lg:flex-row lg:px-6">
        <div class="p-4 flex flex-row items-center justify-between">
            <button class="lg:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 lg:pb-0 hidden lg:flex lg:justify-center lg:flex-row">
            <a href="{{ route('home') }}" data-aos="fade-zoom-in" data-aos-delay="50" data-aos-duration="500" class="px-4 py-2 mt-2 font-semibold bg-transparent rounded-lg lg:mt-0 lg:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300">
                Главная
            </a>
            <a href="{{ route('newsAll') }}" data-aos="fade-zoom-in" data-aos-delay="200" data-aos-duration="500" class="px-4 py-2 mt-2 font-semibold rounded-lg lg:mt-0 lg:ml-4 hover:text-gray-900 hover:bg-gray-200 transition ease-in-out duration-300
            {{ Route::is('newsAll') || Route::is('newsView') ? 'text-gray-900 bg-gray-200 outline-none shadow-outline' : 'bg-transparent' }}">
                Новости
            </a>
            <a href="{{ route('category', 'about') }}" data-aos="fade-zoom-in" data-aos-delay="350" data-aos-duration="500" class="px-4 py-2 mt-2 font-semibold rounded-lg lg:mt-0 lg:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300
            {{ Request::is('category/about') ? 'text-gray-900 bg-gray-200 outline-none shadow-outline' : 'bg-transparent' }}">
                Об учреждении
            </a>
            <div @click.away="open = false" class="relative z-10" x-data="{ open: false }" data-aos="fade-zoom-in" data-aos-delay="500" data-aos-duration="500">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 font-semibold text-left rounded-lg lg:w-auto lg:inline lg:mt-0 lg:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300
                {{ Route::is('contentView') ? 'text-gray-900 bg-gray-200 outline-none shadow-outline' : 'bg-transparent' }}">
                    <span>Структура</span>
                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform lg:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg lg:w-96">
                    <div class="px-2 py-2 bg-zinc-600 rounded-md shadow absolute">
                        @foreach ($structure as $s)
                        <a href="{{ route('contentView', $s['slug']) }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg lg:mt-1 hover:text-gray-900 hover:bg-gray-200 transition ease-in-out duration-300">
                            {{ $s['title'] }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ route('files-list', 'docs') }}" data-aos="fade-zoom-in" data-aos-delay="650" data-aos-duration="500" class="px-4 py-2 mt-2 font-semibold rounded-lg lg:mt-0 lg:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300
            {{ Request::is('files-list/docs') ? 'text-gray-900 bg-gray-200 outline-none shadow-outline' : 'bg-transparent' }}">
                Документы
            </a>
            <a href="{{ route('files-list', 'roads') }}" data-aos="fade-zoom-in" data-aos-delay="800" data-aos-duration="500" class="px-4 py-2 mt-2 font-semibold rounded-lg lg:mt-0 lg:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300
            {{ Request::is('files-list/roads') ? 'text-gray-900 bg-gray-200 outline-none shadow-outline' : 'bg-transparent' }}">
                Дороги
            </a>
            <div @click.away="open = false" class="relative z-10" x-data="{ open: false }" data-aos="fade-zoom-in" data-aos-delay="500" data-aos-duration="500">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 font-semibold text-left rounded-lg lg:w-auto lg:inline lg:mt-0 lg:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300
                {{ Route::is('contentView') ? 'text-gray-900 bg-gray-200 outline-none shadow-outline' : 'bg-transparent' }}">
                    <span>Весовой контроль</span>
                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform lg:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg lg:w-96">
                    <div class="px-2 py-2 bg-zinc-600 rounded-md shadow absolute">
                        <a href="{{ route('carrierAll') }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg lg:mt-1 hover:text-gray-900 hover:bg-gray-200 transition ease-in-out duration-300">
                            Информация для перевозчиков
                        </a>
                        {{-- <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg lg:mt-1 hover:text-gray-900 hover:bg-gray-200 transition ease-in-out duration-300">
                            Документы
                        </a> --}}
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
