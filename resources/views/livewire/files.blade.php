@switch($category)
    @case('docs')
        @php
            $title = 'Документы'
        @endphp
        @break
    @case('roads')
        @php
            $title = 'Дороги'
        @endphp
        @break
    @case('blanks')
        @php
            $title = 'Бланки заявлений'
        @endphp
        @break
    @case('korrup')
        @php
            $title = 'Противодействие коррупции'
        @endphp
        @break
@endswitch

@section('title', $title)

<section class="lg:max-w-7xl lg:mt-8 lg:mr-6">
    <div class="mb-20 text-center">
        <h1 class="text-3xl">{{ $title }}</h1>
        <div class="w-12 pb-1 mb-4 border-b border-gray-600 mx-auto"></div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($files as $item)
        <div class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div class="p-6">
                <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    {{ $item['title'] }}
                </h5>
                <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                    {{ $item['text'] }}
                </p>
                <p class="text-xs text-gray-700">
                    Опубликовано на сайте <span class="font-semibold">{{ $item['created_at']->format('d/m/Y') }}</span>
                </p>
                <div class="mt-4">
                    <a href="{{ Storage::url($item['filename']) }}" target="_blank" class="py-1 px-3 bg-transparent text-sm text-indigo-500 font-semibold border border-indigo-500 rounded hover:bg-indigo-500 hover:text-white hover:border-transparent transition ease-in duration-200 transform">
                        Скачать ({{ number_format(Storage::size($item['filename'])/1024, 0) }} Кб)
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mb-8 mt-6">
        {{ $files->links('vendor.pagination.tailwind') }}
    </div>
</section>
