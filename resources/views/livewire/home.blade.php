<section class="lg:max-w-7xl lg:mt-8 lg:mb-8 lg:mr-6">
    <div class="text-center">
        <h1 class="text-3xl">Новости</h1>
        <div class="w-12 pb-1 mb-4 border-b border-gray-600 mx-auto"></div>
    </div>
    @foreach ($news as $item)
        <div class="grid grid-cols-1 mb-6 md:grid-cols-[200px,1fr] gap-2 border-b lg:border-0">
            <div class="overflow-hidden h-40">
                @if ($item['image'])
                    <img src="{{ route('home') }}/storage/images/news/thumbs/{{ $item['image'] }}"
                        class="object-cover w-48 rounded-xl h-full">
                @else
                    <img src="{{ route('home') }}/storage/noimage.jpg"
                        class="object-cover w-48 rounded-xl h-full">
                @endif
            </div>
            <div class="px-4 lg:px-2 ">
                <div class="text-sm font-medium text-gray-600">
                    {{ $item['created_at']->format('d/m/Y') }}
                </div>
                <div class="w-8 pb-1 border-b border-gray-600"></div>
                <div class="mb-4 ">
                    <a href="{{ route('newsView', $item['slug']) }}" class="font-semibold text-xl text-gray-600 hover:text-indigo-500 ">
                        {{ $item['title'] }}
                    </a>
                </div>
                <div>
                    {!! Str::words(strip_tags($item['text']), 25, ' ...') !!}
                    <a href="{{ route('newsView', $item['slug']) }}" class="text-indigo-500 inline-flex items-center ml-2">
                        Подробнее
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    <div>
        <a href="{{ route('newsAll') }}" class="flex items-center justify-end text-indigo-600 hover:text-indigo-700">
            <div class="mr-4">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M16 2h4v15a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3V0h16v2zm0 2v13a1 1 0 0 0 1 1 1 1 0 0 0 1-1V4h-2zM2 2v15a1 1 0 0 0 1 1h11.17a2.98 2.98 0 0 1-.17-1V2H2zm2 8h8v2H4v-2zm0 4h8v2H4v-2zM4 4h8v4H4V4z"></path></svg>
            </div>
            <div class="text-xl">
                Все новости
            </div>
        </a>
    </div>
</section>
<section class="lg:mt-8 lg:mb-8">
    <div class="lg:max-w-7xl text-center">
        <h1 class="text-3xl">Фотоотчеты</h1>
        <div class="w-12 pb-1 mb-4 border-b border-gray-600 mx-auto"></div>
    </div>
    <div class=" bg-none lg:h-[732px] lg:bg-no-repeat lg:bg-cover lg:bg-right" style="background-image: url('/images/parallax01.jpg')">
        <div class="lg:max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6 lg:max-w-3xl mt-8">
                @foreach ($photoreports as $item)
                    <div class="relative rounded-md shadow-sm overflow-hidden group">
                        @if($item['image'] != null)
                            <img src="{{ route('home') }}/storage/images/photoreports/thumbs/{{ $item['image'] }}" class="object-cover object-center group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 h-[200px] w-full transition duration-500">
                        @else
                            <img src="{{ route('home') }}/storage/noimage.jpg" class="object-cover object-center group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 h-[200px] w-full transition duration-500">
                        @endif
                        <div class="absolute inset-0 h-[300px] group-hover:bg-black opacity-50 transition duration-500 z-0">

                        </div>
                        <div>
                            <div class=" absolute z-10 hidden group-hover:block top-4 right-4">
                                <a href="{{ route('photoreportsView', $item['slug']) }}" class="btn bg-sky-600 hover:bg-sky-700 border-sky-600 hover:border-sky-700 text-white btn-icon rounded-full lightbox">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 9a3.75 3.75 0 100 7.5A3.75 3.75 0 0012 9z"></path>
                                        <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 015.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 01-3 3h-15a3 3 0 01-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 001.11-.71l.822-1.315a2.942 2.942 0 012.332-1.39zM6.75 12.75a5.25 5.25 0 1110.5 0 5.25 5.25 0 01-10.5 0zm12-1.5a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                                      </svg>
                                </a>
                            </div>
                            <div class="absolute z-10 hidden group-hover:block bottom-4 left-4">
                                <a href="{{ route('photoreportsView', $item['slug']) }}" class="h6 text-lg leading-3 font-medium text-white hover:text-sky-300 transition duration-500">
                                    {{ $item['title'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                <a href="{{ route('photoreportsAll') }}" class="flex items-center text-indigo-600 hover:text-indigo-700">
                    <div class="mr-4">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 9a3.75 3.75 0 100 7.5A3.75 3.75 0 0012 9z"></path>
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 015.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 01-3 3h-15a3 3 0 01-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 001.11-.71l.822-1.315a2.942 2.942 0 012.332-1.39zM6.75 12.75a5.25 5.25 0 1110.5 0 5.25 5.25 0 01-10.5 0zm12-1.5a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-xl">
                        Все фотоотчеты
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
