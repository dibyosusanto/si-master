<!DOCTYPE html>
<html lang="en">
<!-- Ini adalah master view untuk halaman admin -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('title')
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/si-master.css') }}">
    </head>

    <body>
        <!-- Navbar -->
            @extends('layouts.header')
        <!-- /Navbar -->

        <!-- Isi -->
        <div class="container">
            @yield('content')
        </div>


        <!-- Footer -->
        @extends('layouts.footer')
        <script src="{{ asset('assets/js/src/jquery.js') }}"></script>
        <script src="{{ asset('assets/js//bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/src/popper.js') }}"></script>
    </body>
</html>