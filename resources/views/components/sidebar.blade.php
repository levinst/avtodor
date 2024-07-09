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
