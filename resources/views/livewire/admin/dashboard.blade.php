@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

<div x-data="{ open: @entangle('openForm') }" class="w-full">
    <div class="py-4 text-xl text-gray-700 font-bold">
        Контакты
    </div>
    <div class="flex">
        <div class="w-1/6 mr-2">
            <label class="block font-medium text-gray-900 mb-1">Телефон 1</label>
            <input wire:model.defer="tel1" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
        </div>
        <div class="w-1/6 mr-2">
            <label class="block font-medium text-gray-900 mb-1">Телефон 2</label>
            <input wire:model.defer="tel2" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
        </div>
        <div class="w-1/6 mr-2">
            <label class="block font-medium text-gray-900 mb-1">E-mail</label>
            <input wire:model.defer="email" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
        </div>
        <div class="flex-1 mr-2">
            <label class="block font-medium text-gray-900 mb-1">Адрес</label>
            <input wire:model.defer="address" type="text" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
        </div>
        <div class="mt-3">
            <button wire:click.prevent="updateContact()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 mt-4 focus:outline-none">
                Сохранить
            </button>
        </div>
    </div>

    <div class="py-4 text-xl text-gray-700 font-bold">
        Об учреждении
        <a href="#" wire:click="edit(1)">
            <svg class="w-6 h-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
            </svg>
        </a>
    </div>

    <div class="py-4 text-xl text-gray-700 font-bold">
        Структура
    </div>

    <button x-on:click="open = true" class="focus:outline-none ml-2 text-white font-bold uppercase bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition ease-in-out duration-500">
        Добавить
    </button>

    <div x-cloak x-show="open" class="fixed top-0 left-0 w-full min-h-screen bg-[rgba(0,0,0,0.5)]">

    </div>

    <div x-cloak x-show="open" x-transition.duration.500ms class="absolute top-10 left-0 right-0 mx-auto z-10 bg-sky-100 p-6 w-full max-w-4xl shadow-xl">
        <div class="mb-8 text-xl text-gray-700 font-bold">
            {{ $updateMode ? "Обновить материал" : "Добавить материал"}}
        </div>
        <form>
            <div class="w-full">
                <label class="block font-medium text-gray-900 mb-1">Заголовок</label>
                <input wire:model.defer="title" type="text" {{ $title == 'Об учреждении' && $updateMode ? 'disabled' : '' }} class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                @error('title') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
            </div>

            <input wire:model="slug" type="text" class="hidden">
            @if($updateMode)
                <input wire:model="selected_id" type="text" class="hidden">
            @endif

            <div>
                <label class="block font-medium text-gray-900 mb-1 mt-8">Текст</label>
                @error('text') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
                <x-tinymce-fm wire:model.defer="text" placeholder="Текст ..." />
            </div>

            @if($updateMode)
                <button wire:click.prevent="update()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 mt-4 focus:outline-none">
                    Обновить
                </button>
            @else
                <button wire:click.prevent="store()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 mt-4 focus:outline-none">
                    Сохранить
                </button>
            @endif
            <button wire:click.prevent="resetInput()" class="text-gray-800 bg-white hover:bg-gray-200 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 focus:outline-none">
                Отмена
            </button>
        </form>
    </div>


    <table class="table table-bordered mt-5">
            @foreach($contents as $item)
                <tr>
                    <td>
                        <div class="flex justify-between">
                            <div class="w-full">
                                {{ $item['title'] }}
                            </div>
                        </div>
                    </td>
                    <td width="80px">
                        <div class="flex">
                            <a href="#" wire:click="edit({{ $item['id'] }})">
                                <svg class="w-6 h-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                                    <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
                                </svg>
                            </a>
                            <a wire:click="delete({{ $item['id'] }})">
                                <svg class="w-6 h-6 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 4c-4.419 0-8 3.582-8 8s3.581 8 8 8 8-3.582 8-8-3.581-8-8-8zm3.707 10.293c.391.391.391 1.023 0 1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293 2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023 0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023 0-1.414s1.023-.391 1.414 0l2.293 2.293 2.293-2.293c.391-.391 1.023-.391 1.414 0s.391 1.023 0 1.414l-2.293 2.293 2.293 2.293z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
    </table>
</div>
