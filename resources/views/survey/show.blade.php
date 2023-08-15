@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')
    <div class="container">

        <x-form action="{{ route('surveys.store') }}" method="POST">
            <x-input type="hidden" name="id" value="{{$id}}"/>
            @foreach($questions as $question)
                <x-survey.question :question="$question" :options="$options"/>
            @endforeach
            <x-button type="submit" class="btn btn-primary">Submit</x-button>
        </x-form>
    </div>
@endsection