@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')
    <main class="flex-shrink-0">
        <div class="container">
            <x-form action="{{ route('defendants.store') }}" method="POST">
                <x-form-item>
                    <x-label required>{{ __('Название') }}</x-label>
                    <x-input type="text" name="name" autofocus/>
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Описание') }}</x-label>
                    <x-input type="text" name="description"/>
                </x-form-item>

                <x-form-item>
                    <h3>Вопрос</h3>
                    <x-checkbox name="remember">
                        {{ __('Запомнить меня') }}
                    </x-checkbox>
                </x-form-item>

                <x-button type="submit">
                    {{ __('Войти') }}
                </x-button>
            </x-form>
        </div>
    </main>
@endsection