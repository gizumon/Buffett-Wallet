<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Buffett Wallet') }}</title>

    <!-- jQuery -->
    <script src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/importstyle_login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle_common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/compare.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

</head>
<body class="d-flex flex-column">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel mygreen_dark">
            <div class="container myheader">
                <a class="navbar-brand font-weight-bold myfont" href="{{ url('/') }}">
                    {{ config('app.name', 'Buffet Wallet') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold myfont" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold myfont" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle myfont font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item myfont_green font-weight-bold" onclick="location.href='/home'">
                                        Home
                                    </a>
                                    <a class="dropdown-item myfont_green font-weight-bold" onclick="location.href='/list'">
                                        List
                                    </a>
                                    <a class="dropdown-item myfont_green font-weight-bold" onclick="location.href='/compare'">
                                        Compare
                                    </a>
                                    <a class="dropdown-item myfont_green font-weight-bold" onclick="location.href='/wallet'">
                                        Wallet
                                    </a>
                                    <a class="dropdown-item myfont_green font-weight-bold" onclick="location.href='/history'">
                                        History
                                    </a>
                                    <a class="dropdown-item myfont_green font-weight-bold" href="{{ route('logout') }}"
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
    </div>
    <main class="content">
        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type='text/javascript' src="{{ asset('js/import/jquery.validate.js') }}" defer></script>
    <script type='text/javascript' src="{{ asset('js/import/additional-methods.js') }}" defer></script>
    <script src="{{ asset('js/common.js') }}" defer></script>
</body>
<footer class="footer mygreen_dark footer-size">
    <p> Developping... Created from April 3rd in 2019.</p>
</footer>
</html>
