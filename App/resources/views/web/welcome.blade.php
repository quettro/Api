@extends('layouts.default')

@section('title', __('Главная страница'))
@section('description', __('Главная страница'))

@section('content')
    <main class="w-[100%] h-[100%] flex justify-center items-center">
        <div x-data="Import({{ $count }})" class="flex items-center flex-row-reverse gap-6">
            <div class="flex items-center gap-3">
                <div>{{ __('Всего') }}: <span class="font-bold" x-text="_all"></span></div>
                <div>{{ __('Добавлено') }}: <span class="font-bold" x-text="_created"></span></div>
                <div>{{ __('Обновлено') }}: <span class="font-bold" x-text="_updated"></span></div>
            </div>

            <div class="">
                <button type="button" class="button --primary" x-bind="importButton">
                    <template x-if="_importButtonIsBlocked !== true">
                        <div class="">
                            {{ __('Импортировать пользователей') }}
                        </div>
                    </template>

                    <template x-if="_importButtonIsBlocked">
                        <div class="flex justify-center items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="fill-current animate-spin">
                                <path d="M222.7 32.1c5 16.9-4.6 34.8-21.5 39.8C121.8 95.6 64 169.1 64 256c0 106 86 192 192 192s192-86 192-192c0-86.9-57.8-160.4-137.1-184.1c-16.9-5-26.6-22.9-21.5-39.8s22.9-26.6 39.8-21.5C434.9 42.1 512 140 512 256c0 141.4-114.6 256-256 256S0 397.4 0 256C0 140 77.1 42.1 182.9 10.6c16.9-5 34.8 4.6 39.8 21.5z" />
                            </svg>
                            <span>{{ __('Идет импорт пользователей, ожидайте...') }}</span>
                        </div>
                    </template>
                </button>
            </div>
        </div>
    </main>
@endsection
