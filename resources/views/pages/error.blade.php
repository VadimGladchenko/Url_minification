<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <style>
        .big-text {
            font-size: 4rem;
        }
    </style>
</head>
<body>
<header class="navbar navbar-dark bg-dark">
    <div class="container">
        <h3 class="text-white m-0">Url Minification</h3>
    </div>
</header>
<div class="container">
    <div class="w-50 m-auto text-center">
        <div class="form-group mt-5" id="results_info_block">
            <h1 class="mt-5 big-text">{{$code}}</h1>
            <h1 class="">{{$message}}</h1>
        </div>

        <a href="/" class="btn btn-dark m-5">Return to main page</a>
    </div>

    <div class="text-center" style="margin-top: 100px;">
        <img class="" src="{{ asset('img/robot.svg') }}" width="200" height="200" alt="robot" style="fill: red;">
    </div>
</div>

</body>
</html>