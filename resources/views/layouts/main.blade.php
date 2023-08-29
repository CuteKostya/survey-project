<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>

    <script>
        var idQuestion = 0;
        var tg = ["text", "checkbox", "radio"];
        let massCountInput = [];


        function addQuestion(el) {
            var questionLabel = document.createElement("label");
            questionLabel.innerText = 'Вопрос';

            var questionInput = document.createElement("input");
            questionInput.id = "questionInput" + idQuestion;
            questionInput.name = "question[" + idQuestion + "][input]";

            var spisok = document.createElement("select");
            spisok.id = "questionSelect" + idQuestion;
            spisok.name = "question[" + idQuestion + "][select]";

            spisok.setAttribute("onchange", "changeSelect(this)");

            spisok.replaceChildren(...tg.map(i => {
                e = document.createElement("option");

                e.innerText = i;
                return e
            }));

            var container = document.createElement("div");
            container.id = "container" + idQuestion;
            container.name = "container" + idQuestion;

            content.append(document.createElement("hr"));
            content.append(questionLabel);
            content.append(document.createElement("br"));
            content.append(questionInput);
            content.append(document.createElement("br"));
            content.append(spisok);
            content.append(document.createElement("br"));
            content.append(container);
            content.append(document.createElement("br"));

            massCountInput[idQuestion] = 0;
            idQuestion++;
        }

        function changeSelect(el) {

            var currentId = el.id.substring(14);
            var sel = document.getElementById(el.id).selectedIndex;

            if (sel === 0) {
                document.getElementById(("container" + currentId)).innerHTML = '';
            } else if (sel === 1 || 2) {
                document.getElementById(("container" + currentId)).innerHTML = '';

                var questionInput = document.createElement("input");
                questionInput.type = "button";
                questionInput.value = "addInput";

                questionInput.setAttribute("onclick", "addCheckbox(this)");
                questionInput.id = "button" + currentId;

                var text = ("container" + currentId + ".append(questionInput)");
                eval(text);
            }

        }

        function addCheckbox(el) {

            var currentId = el.id.substring(6);
            console.log(currentId);

            var br = document.createElement("br");
            var text = ("container" + currentId + ".append(br)");
            eval(text);

            var questionInput = document.createElement("input");
            questionInput.type = "text";
            questionInput.id = "question[" + currentId + "][" + massCountInput[currentId] + "]";
            questionInput.name = "question[" + currentId + "][" + massCountInput[currentId] + "]";
            text = ("container" + currentId + ".append(questionInput)");
            eval(text);
            massCountInput[currentId]++;
        }
    </script>

    <title>@yield('title')</title>
</head>

<body>
<header class="pt-3">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fixed navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('surveys')}}">Survey</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('defendants')}}">defendant</a>
                    </li>
                </ul>
            </div>
        </div>
        <form class="d-flex">
            @if(Auth::user() == null)
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('login')}}">Вход </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('register')}}">Регистрация</a>
                    </li>
                </ul>

            @else
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="{{route('login')}}">{{Auth::user()->name}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('register')}}">{{Auth::user()->avatar}}</a>
                    </li>
                </ul>
            @endif


        </form>
    </nav>

</header>
<main class="flex-shrink-0 pt-5 container">
    @yield('main_content')
</main>
</body>

</html>
