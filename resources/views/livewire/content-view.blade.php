@section('title', $content['title'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <script src="{{ url(asset('js/jquery.js')) }}"></script>
    <style>
        .content-view img {
            display: inline;
        }
    </style>
@endpush

@push('scripts')
    <script>
        jQuery('.content-view img').replaceWith(function(){
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
    <div class="w-full mb-6 border-b lg:border-0">
        <h2 class="mt-2 mb-4 text-2xl font-semibold text-gray-600">
            {{ $content['title'] }}
        </h2>
    </div>
    <div>
        <div class="content-view">
            {!! $content['text'] !!}
        </div>
    </div>
</div>
