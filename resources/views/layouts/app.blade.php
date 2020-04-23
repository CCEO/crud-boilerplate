<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="http://www.cceo.com.mx/assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Sticky footer styles
-------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px; /* Margin bottom by footer height */
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Set the fixed height of the footer here */
            line-height: 60px; /* Vertically center the text there */
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="http://www.cceo.com.mx/assets/images/logo.png" alt="" style="max-height: 40px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item @if(Request::is('system/users')) active @endif">
                                <a class="nav-link" href="{{ route('users.view') }}">{{ __('Users') }} @if(Request::is('system/users'))<span class="sr-only">(current)</span>@endif</a>
                            </li>
                            <li class="nav-item @if(Request::is('system/countries')) active @endif">
                                <a class="nav-link" href="{{ route('countries.view') }}">{{ __('Countries') }} @if(Request::is('system/countries'))<span class="sr-only">(current)</span>@endif</a>
                            </li>
                            <li class="nav-item @if(Request::is('system/states')) active @endif">
                                <a class="nav-link" href="{{ route('states.view') }}">{{ __('States') }} @if(Request::is('system/states'))<span class="sr-only">(current)</span>@endif</a>
                            </li>
                            <li class="nav-item @if(Request::is('system/marital-states')) active @endif">
                                <a class="nav-link" href="{{ route('marital.states.view') }}">{{ __('Marital Status') }} @if(Request::is('system/marital-states'))<span class="sr-only">(current)</span>@endif</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">
                    <a href="http://cceo.com.mx/" target="_blank">CCEO - Software Development</a> {{ date('Y') }}
                </span>
                <span class="float-right">
                    <a href="{{ route('info') }}" target="_blank">{{ __('Project Info') }}</a>
                </span>
            </div>
        </footer>
    </div>
</body>
</html>
