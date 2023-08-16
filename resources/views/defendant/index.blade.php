@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')

    @if($surveys->isEmpty())
        {{  __("Список опроса пуст")}}
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
            @foreach($surveys as $survey)
                <tr>
                    <x-defendant.field-index :survey="$survey"/>

                </tr>
            @endforeach
            </tbody>
        </table>

        <x-button href="{{route('defendants')}}">
            {{__('Создать')}}
        </x-button>

        {{$surveys->links()}}
    @endif
@endsection