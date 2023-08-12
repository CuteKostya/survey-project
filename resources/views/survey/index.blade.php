@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')

    @if($surveys->isEmpty())
        {{  __("Список опроса пуст")}}
    @else
        <div class="container">
            <div class="row">
                @foreach($surveys as $survey)
                    <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                        <a class="fancyimage" rel="group" href="{{route('surveys.show', $survey->id)}}">
                            <x-survey.field :survey="$survey"/>
                        </a>
                    </div>
                @endforeach
                @if(Auth::user()->admin)
                        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                        <text>
                            text
                        </text>
                        </div>
                @endif

            </div>
        </div>
    @endif
@endsection