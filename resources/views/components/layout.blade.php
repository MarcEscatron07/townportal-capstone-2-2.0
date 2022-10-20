<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Town Portal | @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- External CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
</head>
<body>
    @include('partials.header')

    @if(session() != null)
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ session()->get('success') }}</strong> 
            </div>
        @endif  
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ session()->get('error') }}</strong> 
            </div>
        @endif
    @endif

    <main class="main py-4">
        {{-- @yield('content') --}}
        {{$slot}}
    </main>

    <!-- jQuery JS -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script>
        /* jQuery animations */

        //alert
        $(".alert").delay(2500).fadeOut('slow');

        //view profile -> header.blade.php
        $('.profile-container').mouseenter(function(){
            $('.view-profile').removeAttr('hidden');
            $('.view-profile').slideDown(200);
        });
    
        $('.profile-container').mouseleave(function(){
            $('.view-profile').slideUp(200);
        });
    </script>

    @yield('script')
</body>
</html>