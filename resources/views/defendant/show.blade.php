@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')
    <main class="flex-shrink-0">
        <div class="container">
            <x-form method="get">
                <div class="row">
                    <div class="col-4">
                        <x-input type="search" name="search" value="{{ request('search') }}"
                                 placeholder="{{__('Поиск')}}"/>
                    </div>
                    <div class="col-4">
                        <x-button type="submit" class="btn btn-primary">Submit</x-button>
                    </div>
                </div>
            </x-form>
            @if($defendants->isEmpty())
                {{  __("Список прошедших опросов пуст")}}
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">users_id</th>
                        <th scope="col">user name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($defendants as $defendant)
                        <tr>
                                <x-defendant.field :defendant="$defendant"/>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$defendants->links()}}
            @endif
        </div>
    </main>
@endsection