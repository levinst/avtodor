@if ($count_q > 0)
    @section('count_q', $count_q)
@endif

<div x-data="{ open: @entangle('openForm') }" class="w-full">
    <div class="py-4 text-xl text-gray-700 font-bold">
        Вопросы
    </div>

    <div x-cloak x-show="open" class="top-0 left-0 fixed w-full min-h-screen bg-[rgba(0,0,0,0.5)]">

    </div>

    <div x-cloak x-show="open" x-transition.duration.500ms class="absolute m-auto top-10 left-0 right-0 z-10 bg-sky-100 p-6 w-full max-w-4xl shadow-xl">
        <div class="mb-8 text-xl text-gray-700 font-bold">
            Ответить на вопрос
        </div>
        <div class="py-2 font-semibold text-lg">
            {{ $name }}
        </div>
        <div class="py-2">
            {!! $question !!}
        </div>
        <form>
            <input type="hidden" wire:model="selected_id">

            <div class="w-full mb-6">
                <label class="block mb-2 font-semibold text-gray-900">Ответ:</label>
                <textarea wire:model.defer="answer" rows="12" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Текст..."></textarea>
            </div>

            <button wire:click.prevent="update()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 mt-4 focus:outline-none">
                Опубликовать
            </button>
            <button wire:click.prevent="resetInput()" class="text-gray-800 bg-white hover:bg-gray-200 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 focus:outline-none">
                Отмена
            </button>
        </form>
    </div>

    <table class="table table-bordered mt-5">
            @foreach($faqs as $item)
                <tr class="{{ $item['published'] ? 'bg-green-100' : '' }}">
                    <td width="300px">
                        {{ $item['name'] }}
                        {!! $item['email'] ? '<br /><a href="mailto:'.$item['email'].'" class="text-indigo-500">'.$item['email'].'</a>' : '' !!}
                        <br /><span class="text-gray-500 text-xs">{{ $item['created_at']->format('d/m/Y H:i:s') }}</span>
                    </td>
                    <td>{!! $item['question'] !!}</td>
                    <td width="80px">
                        <div class="flex">
                            <a href="#" wire:click="edit({{ $item['id'] }})">
                                @if ($item['published'] == 0)
                                    <svg class="w-6 h-6 text-blue-700" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                                        <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
                                    </svg>
                                @endif
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
        {{ $faqs->links('vendor.pagination.tailwind') }}
    </div>
</div>
