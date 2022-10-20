<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Town Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- External CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Inline CSS -->
    <style>
        .header-title {
            font-size: 2.5rem;
        }
        .subheader-title {
            font-size: 1.2rem;
        }
        .nav-pills .nav-link.active {
            background-color: #343a40 !important;
        }
    </style>

    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm">
            <div class="container d-flex justify-content-center">
                <div class="text-center text-white">
                    {{-- <a class="text-decoration-none text-white" href="{{ url('/') }}"> --}}
                    <a class="text-decoration-none text-white" href="#">
                        <div class="p-2">
                            <i class="fas fa-scroll fa-2x"></i>
                            <h1 class="header-title">Town Portal</h1>
                        </div>
                    </a>
                    <h2 class="subheader-title m-0">Internet Cafe</h2>
                    <h2 class="subheader-title">Asset Management System</h2>
                </div>     
            </div>
        </nav>

        <main class="py-4 mt-3">
            @yield('content')
        </main>
    </div>

    <!-- jQuery JS -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
