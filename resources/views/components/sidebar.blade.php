<ul class="space-y-2 tracking-wide mt-8">
    <li>
        <a href="{{ route('files-list', 'blanks') }}" class="{{ Request::is('files-list/blanks') ? 'text-white bg-yellow-400' : 'bg-zinc-100' }} px-4 py-3 flex items-center space-x-4 rounded-md text-gray-700 group  hover:text-white hover:bg-zinc-600 transition ease-in-out duration-500">
            <span class="">Бланки заявлений</span>
        </a>
    </li>
    <li>
        <a href="{{ route('photoreportsAll') }}" class="{{ Route::is('photoreportsAll') || Route::is('photoreportsView') ? 'text-white bg-yellow-400' : 'bg-zinc-100' }} px-4 py-3 flex items-center space-x-4 rounded-md text-gray-700 focus:text-white focus:bg-yellow-400 hover:text-white hover:bg-zinc-600 transition ease-in-out duration-500">
           <span class="">Фотоотчёты</span>
        </a>
    </li>
    <li>
        <a href="{{ route('files-list', 'korrup') }}" class="{{ Request::is('files-list/korrup') ? 'text-white bg-yellow-400' : 'bg-zinc-100' }} px-4 py-3 flex items-center space-x-4 rounded-md text-gray-700 group focus:text-white focus:bg-yellow-400 hover:text-white hover:bg-zinc-600 transition ease-in-out duration-500">
           <span class="">Противодействие коррупции</span>
        </a>
    </li>
    @foreach ($categories as $c)
        <li>
            <a href="{{ route('category', $c['slug']) }}" class="{{ Request::is('category/'.$c['slug']) ? 'text-white bg-yellow-400' : 'bg-zinc-100' }} px-4 py-3 flex items-center space-x-4 rounded-md text-gray-700 group focus:text-white focus:bg-yellow-400 hover:text-white hover:bg-zinc-600 transition ease-in-out duration-500">
                <span class="">{{ $c['title'] }}</span>
            </a>
        </li>
    @endforeach
    <li>
        <div @click.away="open = false" class="relative z-10" x-data="{ open: false }">
            <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline  transition ease-in-out duration-300
            {{ Route::is('contentView') ? 'text-white bg-yellow-400' : 'bg-zinc-100' }} px-4 py-3 flex items-center space-x-4 rounded-md text-gray-700 group focus:text-white focus:bg-yellow-400 hover:text-white hover:bg-zinc-600 transition ease-in-out duration-500">
                <span>Весовой контроль</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform lg:-mt-0"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <div x-cloak x-show="open" class="absolute left-6 w-full origin-top-right rounded-md shadow-lg lg:w-96" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                <div class="w-full absolute bg-zinc-200 rounded">
                    <a href="{{ route('carrierAll') }}" class="{{ Route::is('carrierAll') || Route::is('carrierAll') ? 'text-white bg-yellow-400' : 'bg-zinc-100' }}  block px-4 py-2 mt-2 text-sm font-semibold rounded-lg lg:-mt-1 hover:text-gray-900 hover:bg-gray-200 transition ease-in-out duration-300">
                        Информация для перевозчиков
                    </a>
                    <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg lg:mt-1 hover:text-gray-900 hover:bg-gray-200 transition ease-in-out duration-300">
                        Документы
                    </a>
                </div>
            </div>
        </div>
    </li>
    <li>
        <a href="{{ route('faqs-list') }}" class="{{ Route::is('faqs-list') ? 'text-white bg-yellow-400' : 'bg-zinc-100' }} px-4 py-3 flex items-center space-x-4 rounded-md text-gray-700 group focus:text-white focus:bg-yellow-400 hover:text-white hover:bg-zinc-600 transition ease-in-out duration-500">
            <span class="">Вопрос-ответ</span>
        </a>
    </li>
</ul>
<ul class="mt-8">
    @foreach ($banners as $b)
        @if ($b['type'] == 0)
            <li class="mt-4 flex justify-center">
                <a href="{{ $b['url'] }}"><img src="{{ Storage::url($b['image']) }}"></a>
            </li>
        @else
            <li class="mt-4 flex justify-center">
                {!! $b['code'] !!}
            </li>
        @endif
    @endforeach
</ul>
