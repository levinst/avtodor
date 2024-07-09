@section('title', $category['title'])

<section class="lg:max-w-7xl lg:mt-8 lg:mr-6">
    <div class="mb-20 text-center">
        <h1 class="text-3xl">{{ $category['title'] }}</h1>
        <div class="w-12 pb-1 mb-4 border-b border-gray-600 mx-auto"></div>
    </div>
    @php
        //dd($category->contents);
    @endphp
    @if ($category->contents->count() == 1)
        @foreach ($category->contents as $content)
            {!! $content['text'] !!}
        @endforeach
    @else
        <ul class="[&>*:nth-child(even)]:bg-slate-100 [&>*:nth-child(odd)]:bg-white">
            @foreach ($category->contents as $content)
                <li class="p-3 text-lg">
                    <a href="{{ route('contentView', $content['slug']) }}">{{ $content['title'] }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</section>
