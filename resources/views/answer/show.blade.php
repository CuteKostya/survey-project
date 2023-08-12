@extends('layouts.main')

@section('page.title', 'Опрос')


@section('main_content')
    <main class="flex-shrink-0">
        <div class="container">
            @php
                $currentId = 0
            @endphp
            @foreach($answers as $answer)
                @if($currentId != $answer->id)
                    <h2>
                        {{$answer->question}}
                    </h2>
                @endif
                <div>
                    <x-answer.question :answer="$answer"/>
                </div>
                @php
                    $currentId = $answer->id
                @endphp
            @endforeach

        </div>
    </main>
@endsection