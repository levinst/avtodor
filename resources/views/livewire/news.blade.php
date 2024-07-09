@section('title', 'Новости')

<section class="lg:max-w-7xl lg:mt-8 lg:mr-6">
    <div class="mb-20 text-center">
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
</section>
