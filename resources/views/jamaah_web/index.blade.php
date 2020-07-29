@extends('jamaah_web.master')
@section('content')
    <div class="jumbotron jumbotron-fluid my-4">
        <div class="container">
            <h1 class="display-3">Selamat Datang, {{ $jamaah_web->nama_jamaah ?? '' }} </h1>
            <hr class="my-2">
        </div>
    </div>
    <div class="container">
      <hr>
        <p class="font-weight-bold"> <i class="fas fa-mosque"></i> List Masjid Terdaftar</p>
        <div class="align-items-center">
            @include('jamaah_web.masjid')      
        </div>
    </div>
    <div class="container">
      <hr>
        <div class="align-items-center">
            @include('jamaah_web.pengumuman')
        </div>
    </div>
    
@endsection