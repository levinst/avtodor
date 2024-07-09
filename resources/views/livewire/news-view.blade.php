@section('title', 'Новости')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <script src="{{ url(asset('js/jquery.js')) }}"></script>
    <style>
        .news-view img {
            display: inline;
        }
    </style>
@endpush

@push('scripts')
    <script>
        jQuery('.news-view img').replaceWith(function(){
	        var thumb = this.src,
	            fullImage = thumb.replace(/\/thumbs/, "");
	        return '<a class="fancybox" href="' + fullImage + '" data-fancybox="gallery" data-caption="'+ this.alt +'" >' +
	                        '<img class="fancybox_img m-2"  src="' + thumb + '" width="200">' +
	                '</a>';
	    });
    </script>
    <script src="{{ url(asset('js/fancybox.umd.js')) }}"></script>
    <script src="{{ url(asset('js/en.umd.js')) }}"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            l10n : Fancybox.l10n.en
        });
    </script>
@endpush

<div class="lg:max-w-7xl lg:mt-8 lg:mr-6">
    <div class="grid grid-cols-1 w-full mb-6  gap-2 border-b lg:border-0">
        <div class="">
            <div class="text-sm font-medium text-gray-600">
                {{ $news['created_at']->format('d/m/Y') }}
            </div>
            <div class="w-8 pb-1 mb-4 border-b border-gray-600"></div>
            <h2 class="mt-2 mb-4 text-2xl font-semibold text-gray-600">
                {{ $news['title'] }}
            </h2>
        </div>
    </div>
    <div>
        <div class="news-view">
            {!! $news['text'] !!}
        </div>
    </div>
    <a href="{{ route('newsAll') }}" class="flex items-center mt-6 text-indigo-500">
        <svg class="w-8 h-8" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" fill="white" fill-opacity="0.01"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M44 40.8361C39.1069 34.8632 34.7617 31.4739 30.9644 30.6682C27.1671 29.8625 23.5517 29.7408 20.1182 30.303V41L4 23.5453L20.1182 7V17.167C26.4667 17.2172 31.8638 19.4948 36.3095 24C40.7553 28.5052 43.3187 34.1172 44 40.8361Z" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linejoin="round"></path></svg>
        <p class="ml-4 mt-3">Все новости</p>
    </a>
</div>
