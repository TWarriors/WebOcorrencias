<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/table-short.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pesquisarTable.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ocorrencias Web') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <div class="ui stackable massive inverted menu">
            <div class="container">

                @if (Auth::guest())

                    <a class="active item" href="{{ url('/') }}">
                    {{ config('app.name', 'Ocorrencias Web') }}
                    </a>

                @else

                <a class="active item" href="{{ url('/') }}">
                {{ config('app.name', 'Ocorrencias Web') }}
                </a>

                @endif

            <div class="right menu">

                @if (Auth::guest())

                <div class="item">
                    <a class="ui secondary button" href="{{ route('login') }}">Entrar</a>
                </div>
                <div class="item">
                    <a class="ui secondary button" href="{{ route('register') }}">Registrar</a>
                </div>

                @else

                    <a class="item" href="/">Início</a>
                    <a class="item" href="/home">Home</a>

                @endif

            </div>
            </div>
        </div>
        <div class="ui grid">
        @yield('content')
      </div>
    </div>

</body>
</html>
