<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div id="ReactNavBar"
            data-appname="{{ config('app.name', 'Laravel') }}"
            data-csrftoken="{{ csrf_token() }}"
            data-name="{{ Auth::user() ? Auth::user()->name : '' }}"
            data-homeurl="{{ url('/') }}"
            data-loginurl="{{ route('login') }}"
            data-logintext="{{ __('Login') }}"
            data-logouturl="{{ route('logout') }}"
            data-logouttext="{{ __('Logout') }}"
            data-regisurl="{{ route('register') }}"
            data-registext="{{ __('Register') }}"
        ></div>

        <main class="py-4" id="content">
            @yield('content')
        </main>
    </div>
</body>
</html>
