@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

<div x-data="{ open: @entangle('openForm') }" class="w-full">
    <div class="py-4 text-xl text-gray-700 font-bold">
        Файлы
    </div>

    <button x-on:click="open = true" class="focus:outline-none ml-2 text-white font-bold uppercase bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition ease-in-out duration-500">
        Добавить
    </button>

    <div x-cloak x-show="open" class="fixed top-0 left-0 w-full min-h-screen bg-[rgba(0,0,0,0.5)]">

    </div>

    <div x-cloak x-show="open" x-transition.duration.500ms class="absolute m-auto top-10 left-0 right-0 z-10 bg-sky-100 p-6 w-full max-w-xl shadow-xl">
        <div class="mb-8 text-xl text-gray-700 font-bold">
            {{ $updateMode ? "Обновить файл" : "Добавить файл"}}
        </div>
        <form>
            @if($updateMode)
                <input type="hidden" wire:model="selected_id">
            @endif

            <div class="w-full mb-4">
                <label class="block font-medium text-gray-900 mb-1">Категория</label>
                <select wire:model.defer="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option value="docs">Документы</option>
                    <option value="roads">Дороги</option>
                    <option value="blanks">Бланки заявлений</option>
                    <option value="korrup">Противодействие коррупции</option>
                </select>
            </div>
            <div class="w-full mb-4">
                <label class="block font-medium text-gray-900 mb-1">Заголовок</label>
                <input wire:model.defer="title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                @error('title') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
            </div>
            <div class="flex w-full mb-4">
                <div class="w-40">
                    <label class="block font-medium text-gray-900 mb-1">Дата публикации</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input wire:model="created_at" id="created_at" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 px-2.5" placeholder="Выберите дату">
                    </div>
                </div>
                <div class="flex-1 ml-2">
                    <label class="block mb-2 font-medium text-gray-900">Файл</label>
                    <input wire:model.defer="filename" id="upload{{ $iteration }}" type="file" accept=".jpg,.png,.pdf,.txt,.csv,.zip,.7zip,.doc,.docx,.xls,.xlsx" class="block w-full -mt-1.5 pt-0 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"/>
                    @error('filename') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
                </div>
            </div>
            <div class="w-full mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание файла (необязательно)</label>
                <textarea wire:model.defer="text" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Текст..."></textarea>
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

    <div class="flex flex-row justify-end">
        <div class="w-1/4 mr-4">
            <label class="block font-medium text-gray-900 mb-1">Поиск</label>
            <input wire:model="searchTerm" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
        </div>
        <div class="w-1/4">
            <label class="block font-medium text-gray-900 mb-1">Категория</label>
            <select wire:model="filterTerm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value=""></option>
                <option value="docs">Документы</option>
                <option value="roads">Дороги</option>
                <option value="blanks">Бланки заявлений</option>
                <option value="korrup">Противодействие коррупции</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered mt-5">
            @foreach($files as $item)
                <tr>
                    <td>{{ $item['title'] }}</td>
                    <td width="80px">
                        <div class="flex">
                            <a href="#" wire:click="edit({{ $item['id'] }})">
                                <svg class="w-6 h-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                                    <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
                                </svg>
                            </a>
                            <a wire:click="delete({{ $item['id'] }})" class="cursor-pointer">
                                <svg class="w-6 h-6 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 4c-4.419 0-8 3.582-8 8s3.581 8 8 8 8-3.582 8-8-3.581-8-8-8zm3.707 10.293c.391.391.391 1.023 0 1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293 2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023 0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023 0-1.414s1.023-.391 1.414 0l2.293 2.293 2.293-2.293c.391-.391 1.023-.391 1.414 0s.391 1.023 0 1.414l-2.293 2.293 2.293 2.293z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
    </table>
    <div class="mb-8 mt-6">
        {{ $files->links('vendor.pagination.tailwind') }}
    </div>
</div>
