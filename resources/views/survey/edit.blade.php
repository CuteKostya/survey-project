@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')

    @if($surveys->isEmpty())
        {{  __("Список опроса пуст")}}
    @else

    @endif
@endsection