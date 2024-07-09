@push('scripts')
    <script>
        var email_regex = /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi;

        let elements = document.querySelectorAll('.answer');

        for (let elem of elements) {
            elem.innerHTML = elem.innerHTML.replace(email_regex,'<a class="text-indigo-500" href="mailto:$1">$1</a>');
        }
    </script>
@endpush

@section('title', 'Вопрос-ответ')

<section class="lg:max-w-7xl lg:mt-8 lg:mr-6">
    <div class="max-w-5xl mx-auto">
        <div class="text-center">
            <h1 class="text-3xl">Вопрос-ответ</h1>
            <div class="w-12 pb-1 mb-4 border-b border-gray-600 mx-auto"></div>
        </div>

        <div class="h-16">
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-cloak x-transition.duration.500ms x-init="setTimeout(() => show = false, 3000)" class="mx-auto max-w-lg text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 " role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div x-data="{ expanded: false }">
            <div class="mx-auto max-w-lg mb-4 ">
                <button @click="expanded = ! expanded" class="py-1 px-3 bg-transparent text-sm text-indigo-500 font-semibold border border-indigo-500 rounded hover:bg-indigo-500 hover:text-white hover:border-transparent transition ease-in duration-200">
                    <span x-show="!expanded" x-cloak >Задать вопрос</span>
                    <span x-show="expanded" x-cloak >Отмена</span>
                </button>
            </div>
            <div x-show="expanded" x-cloak x-collapse.duration.500ms class="mx-auto max-w-lg">
                <div class="flex mb-4">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                    </span>
                    <input wire:model="name" type="text" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-0 focus:border-gray-300 block flex-1 min-w-0 w-full text-sm p-2.5" placeholder="Ваше имя">
                </div>
                <div class="flex mb-4">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                        </svg>
                    </span>
                    <input wire:model="email" type="text" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-0 focus:border-gray-300 block flex-1 min-w-0 w-full text-sm p-2.5" placeholder="Ваше E-mail">
                </div>
                <div class="flex mb-4">
                    <textarea wire:model="question" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0 focus:border-gray-300" placeholder="Ваш вопрос..."></textarea>
                </div>
                <div class="flex justify-between">
                    <div class="leading-3">
                        @error('name') <span class="text-red-600 text-xs">{{ $message }}.</span><br>@enderror
                        @error('email') <span class="text-red-600 text-xs">{{ $message }}.</span><br>@enderror
                        @error('question') <span class="text-red-600 text-xs">{{ $message }}.</span>@enderror
                    </div>
                    <button wire:click="store()" @if (session()->has('message')) x-init="expanded = false" @endif type="button" class="text-white bg-gradient-to-r from-indigo-500 via-indigo-600 to-indigo-700 hover:bg-gradient-to-br focus:ring-0 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                        Отправить
                    </button>
                </div>
            </div>
        </div>


        <div class="w-full mt-8">
            <div class="grid grid-cols-1 gap-8">
                @foreach ($faqs as $f)
                    <div class="flex border-b border-b-slate-100 pb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="mr-4 mt-8 text-indigo-500" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex w-full justify-between">
                                <div class="text-indigo-500 font-bold">
                                    {{ $f['name'] }}
                                </div>
                                <div class="text-gray-500 text-xs">
                                    {{ $f['created_at']->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="font-semibold text-sm">
                                {!! $f['question'] !!}
                            </div>
                            <div class="mt-3 text-sm text-gray-500 answer">
                                {!! $f['answer'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
