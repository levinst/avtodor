@push('scripts')
    <script src="{{ url(asset('js/livewire-sortable.js')) }}"></script>
@endpush

<div class="w-full">
    <div class="py-4 text-xl text-gray-700 font-bold">
        Баннеры
    </div>

    <div class="flex">
        <div class="w-1/2 pr-4">
            <div class="w-full mb-2">
                <div class="flex justify-between">
                    <div class="flex-1 mr-8">
                        <label class="block font-medium text-gray-900 mb-1">Заголовок</label>
                        <input wire:model.defer="title" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                        @error('title') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
                    </div>
                    <div class="w-20 mt-7">
                        <div class="flex items-center">
                            <input wire:model="type" type="radio" name="banners" value="0" class="w-4 border-gray-300 focus:ring-2 focus:ring-blue-300 " checked>
                            <label class="block ml-2 text-sm font-medium text-gray-900">
                                Баннер
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="type" type="radio" name="banners" value="1" class="w-4 border-gray-300 focus:ring-2 focus:ring-blue-300 ">
                            <label class="block ml-2 text-sm font-medium text-gray-900">
                                Код
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full mb-2">
                <label class="block font-medium text-gray-900 mb-1">Url-адрес сайта</label>
                <input wire:model.defer="url" {{ $type ? 'disabled' : '' }} type="text" class="{{ $type ? 'bg-gray-300' : '' }} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                @error('url') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
            </div>

            <div class="flex-1 mb-2">
                <label class="block mb-2 font-medium text-gray-900">Баннер</label>
                <input wire:model.defer="image" id="upload{{ $iteration }}" {{ $type ? 'disabled' : '' }} type="file" accept=".jpg,.png,.gif" class="{{ $type ? 'bg-gray-300' : '' }} block w-full -mt-1.5 pt-0 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"/>
                @error('image') <span class="text-red-600 text-sm">{{ $message }}.</span>@enderror
            </div>
        </div>
        <div class="w-1/2 pl-4">
            <div class="w-full">
                <label class="block mb-1 code-sm font-medium text-gray-900">Код</label>
                <textarea wire:model.defer="code" {{ !$type ? 'disabled' : '' }} rows="8" class="{{ !$type ? 'bg-gray-300' : '' }} block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
        </div>

    </div>
    <button wire:click="store()" class="focus:outline-none mt-2 text-white font-bold uppercase bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition ease-in-out duration-500">
        Добавить
    </button>


    <table wire:sortable="updateBannerOrder" class="table table-bordered mt-5">
            @foreach($banners as $item)
                <tr wire:sortable.item="{{ $item['id'] }}" wire:key="task-{{ $item['id'] }}" wire:sortable.handle>
                    <td width="40px">
                        <svg class="w-6 h-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 16 16" fill="currentColor"><path fill="currentColor" d="M11 7h-6l3-4z"></path><path fill="currentColor" d="M5 9h6l-3 4z"></path></svg>
                    </td>
                    <td width="40px">
                        <div class="flex">
                            <a wire:click="delete({{ $item['id'] }})" class="cursor-pointer">
                                <svg class="w-6 h-6 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 4c-4.419 0-8 3.582-8 8s3.581 8 8 8 8-3.582 8-8-3.581-8-8-8zm3.707 10.293c.391.391.391 1.023 0 1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293 2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023 0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023 0-1.414s1.023-.391 1.414 0l2.293 2.293 2.293-2.293c.391-.391 1.023-.391 1.414 0s.391 1.023 0 1.414l-2.293 2.293 2.293 2.293z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                    <td class="cursor-pointer">{{ $item['title'] }}</td>
                </tr>
            @endforeach
    </table>
</div>
