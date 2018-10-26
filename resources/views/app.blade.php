<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://unsplash.it/1200/900?random) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body {
            color: #fff;
        }

        .title {
            color: #fff;
        }

    </style>
</head>

<body>
    <div class="hero">
        <!-- Authentication Links -->
        @guest
        @else
        <header class="hero-head">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        <div class="navbar-item">
                            <a href="/">
                                <h1 class="title">{{ config('app.name') }}</h1>
                            </a>
                        </div>
                    </div>

                    <div class="navbar-menu">
                        <div class="navbar-end">
                            <div class="navbar-item">
                                <a class="button is-white is-outlined" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                {!! Form::open(['route' => 'logout', 'id' => 'logout-form', 'style' => 'display:
                                none;'])
                                !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        @endguest
        <main class="hero-body">
            @yield('content')
        </main>
    </div>
</body>

</html>
