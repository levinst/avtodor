@extends('layouts.base')

@section('body')

    <section>
        <header class="bg-gray-100">
            <div class="lg:flex lg:items-center max-w-6xl mx-auto p-2">
                <img class="hidden lg:block" src="{{ asset('images/kamchatka-gerb.png') }}">
                <div class="lg:flex lg:justify-between w-full">
                    <div class="ml-6 text-center lg:text-left">
                        <p class="text-sm lg:text-base">Краевое государственное казенное учреждение</p>
                        <p class="font-semibold lg:text-2xl">Управление автомобильных дорог Камчатского края</p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="flex items-center">
							<div>
								<svg class="w-4 h-4 mr-2 mt-1.5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"></path></svg>
							</div>
							<div>
								<span>{{ $contacts['tel1'] }}</span><br />
								<span>{{ $contacts['tel2'] }}</span>
							</div>
                        </div>
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2 mt-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="m16.484 11.976 6.151-5.344v10.627zm-7.926.905 2.16 1.875c.339.288.781.462 1.264.462h.017-.001.014c.484 0 .926-.175 1.269-.465l-.003.002 2.16-1.875 6.566 5.639h-20.009zm-6.572-7.516h20.03l-9.621 8.356c-.104.082-.236.132-.38.132-.005 0-.009 0-.014 0h.001c-.004 0-.009 0-.014 0-.144 0-.277-.05-.381-.133l.001.001zm-.621 1.266 6.15 5.344-6.15 5.28zm21.6-2.441c-.24-.12-.522-.19-.821-.19h-20.285c-.3.001-.584.071-.835.197l.011-.005c-.618.309-1.035.937-1.035 1.663v.004 12.168c.001 1.026.833 1.857 1.858 1.858h20.283c1.026-.001 1.857-.833 1.858-1.858v-12.168c0-.001 0-.002 0-.004 0-.727-.419-1.357-1.029-1.66l-.011-.005z"></path></svg>
                            <span>{{ $contacts['email'] }}</span></p>
                    </div>
                </div>
            </div>
            <x-navbar/>
        </header>
    </section>

    @if(Route::is('home') )
        <section>
            <div class="w-full lg:h-[732px] bg-no-repeat bg-cover" style="background-image: url('images/bg_slide0{{ rand(1,3) }}.jpg')">
                <div class="w-full h-full bg-[rgba(0,0,0,0.6)]">
                    <div class="flex items-center h-full">
                        <div class="text-gray-200 text-center mx-auto">
                            <h2 class="animate__animated animate__fadeInDown lg:text-4xl mb-4">Краевое государственное казенное учреждение</h2>
                            <h1 class="animate__animated animate__fadeIn text-xl lg:text-6xl text-yellow-400">Управление автомобильных дорог Камчатского края</h1>
                            <p class="animate__animated animate__fadeInUp mt-8 max-w-3xl mx-auto text-sm p-2 lg:text-xl">Cвоей основной задачей “Управление автомобильных дорог Камчатского края” видит создание и поддержание современных дорог круглый год до каждого населённого пункта и для каждого жителя и гостя Камчатского края</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div class="lg:flex">
        <div class="w-full px-4 lg:px-0 lg:w-96 lg:mx-8">
            <x-sidebar/>
        </div>
        <div id="maincontent" class="px-2 mt-4 lg:px-6 w-full">
            @yield('content')
        </div>
    </div>

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
