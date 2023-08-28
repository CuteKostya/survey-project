@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')
    <main class="flex-shrink-0">
        <div class="container">
            <x-form action="{{ route('defendants.store') }}" method="POST">
                <x-input type="hidden" value="10" name="quantity"/>
                <x-form-item>
                    <x-label required>{{ __('Название') }}</x-label>
                    <x-input type="text" name="name" autofocus/>
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Описание') }}</x-label>
                    <x-input type="text" name="description"/>
                </x-form-item>
                <div id="content">
                </div>
                <x-input type="button" value="Добавить вопрос" onclick="addQuestion(this)"/>

  
                <x-button type="submit">
                    {{ __('Создать опрос') }}
                </x-button>
            </x-form>
        </div>
    </main>
@endsection