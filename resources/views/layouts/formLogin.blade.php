<!DOCTYPE html>
<html lang="en">
    <!-- Ini adalah master view untuk halaman admin -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('title')
        <!-- <link rel="stylesheet" href="../../../public/assets/css/style.css"> -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>
    <body>
        <div class="login-card">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        </div>
    </body>
</html>
