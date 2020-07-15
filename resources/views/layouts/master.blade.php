<!doctype html>
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}"><img alt="SI-MASTER" src="{{ asset('logo/logo.png') }}" width="90px" height="25px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Beranda
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Infaq</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Zakat</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"> <img height=30px src="{{ asset('assets/img/user.png') }}"> </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </li>
                            
                            @else
                            <li class="nav-item">
                                <button type="button" name="commit" class="btn btn-outline-primary" data-toggle="modal" data-target="#login">Login</button>
                            </li>
                            @endauth
                        @endif
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /Navbar -->

        <!-- Isi -->
        <div class="container">
            @yield('content')
        </div>


        <!-- Footer -->
        @extends('layouts.footer')
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/popper.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        
         <!-- Form Login -->
<div class="modal fade" id="login" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
          <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <img class="rounded mb-5 mx-auto d-block" src="{{ asset('logo/logo.png') }}" width="50%" height="100%">

                    <!-- ACTIONNYA MENGARAH PADA URL /LOGIN -->
                    <!-- UNTUK MENCARI TAU TUJUAN URI DARI ROUTE NAME DIBAWAH, PADA COMMAND LINE, KETIKKAN PHP ARTISAN ROUTE:LIST DAN CARI URI YANG MENGGUNAKAN METHOD POST -->
                    <!-- KARENA URI /LOGIN DENGAN METHOD GET DIGUNAKAN UNTUK ME-LOAD VIEW HALAMAN LOGIN -->
                    <!-- PENGGUNAAN ROUTE() APABILA ROUTING TERSEBUT MEMILIKI NAMA, ADAPUN NAMENYA ADA PADA COLOM NAME ROUTE:LIST -->
                    <!-- JIKA ROUTINGNYA TIDAK MEMILIKI NAMA, MAKA GUNAKAN HELPER URL() DAN DIDALAMNYA ADALAH URINYA. CONTOH URL('/LOGIN') -->
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                          
                            <!-- $errors->has('email') AKAN MENGECEK JIKA ADA ERROR DARI HASIL VALIDASI LARAVEL, SEMUA KEGAGALAN VALIDASI LARAVEL AKAN DISIMPAN KEDALAM VARIABLE $errors -->
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                type="email" 
                                name="email"
                                placeholder="Email Address" 
                                value="{{ old('email') }}" 
                                autofocus 
                                required>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                type="password" 
                                name="password"
                                placeholder="Password" 
                                required>
                        </div>
                        <div class="row">
                            @if (session('error'))
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            </div>
                            @endif

                            <div class="col-6">
                                <button class="btn btn-link px-0" type="button">Forgot password?</button>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-primary px-4">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>
    <!-- /Form Login -->
    </body>
</html>