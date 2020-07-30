@extends('layouts.master')

@section('title')
    <title> SI-MASTER </title>
@endsection

@section('content')

    <!-- Jumbotron Header -->
    <div class="container">
        <header class="jumbotron my-4 text-center">
            <h1 class="display-4 font-weight-bold">Selamat Datang di Web SI-MASTER</h1>
            <p class="lead">
              “Hanyalah yang memakmurkan masjid-masjid Allah ialah orang-orang
              yang beriman kepada Allah dan hari kemudian, serta tetap mendirikan shalat,
              menunaikan zakat dan tidak takut (kepada siapapun) selain kepada Allah.
              Maka merekalah orang-orang yang diharapkan termasuk golongan orang-orang
              yang mendapat petunjuk” (QS. At-Taubah [9]: 18)
            </p>
            @if (Route::has('login'))
              @auth
              
              @else
                <a href="{{ route('index.daftar') }}" class="btn btn-primary btn-xl rounded-pill">Sign Up</a>
              @endauth
              
            @endif
        </header>
    </div>

    <section id="masjid">
      <div class="container">
      <hr>
          <p class="font-weight-bold"> <i class="fas fa-mosque"></i> List Masjid Terdaftar</p>
          <div class="align-items-center">
            @include('guest.list_masjid')      
          </div>
      </div>
      
    </section>

  
    <section id="announcements">
      <div class="container">
        <hr class="divider">
        <div class="align-items-center">
          @include('guest.pengumuman')      
        </div>
      </div>
      
    </section>

    <section id="about">
    <div class="container">
    <hr>
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="{{ asset('assets/img/izuddin-helmi-adnan-unsplash - Copy.jpg') }}" alt="">
              <div class="mt-4">
                <p class="text-center">(Sumber : Unsplash by Izuddin Helmi Adnan)</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 order-lg-1">
            <div class="p-5">
              <h2 class="display-4 font-weight-bold">Tentang Kami</h2>
              <hr class="divider my-4"/>
              <p class="text-justify">
                SI-MASTER adalah sebuah situs web yang dibuat untuk menghubungkan antara jamaah dengan masjid.
                Diharapkan dengan adanya SI-MASTER ini, jamaah lebih dimudahkan dalam mengakses informasi dari masjid - masjid yang telah bergabung
              </p>
            </div>
          </div>
        </div>
    </div>
    </section>

    <!-- <section id="panduan"> 
    <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="img/02.jpg" alt="">
            </div>
          </div>
         <div class="col-lg-6">
            <div class="p-5">
              <h2 class="display-4">Panduan Penggunaan</h2>
              <hr class="divider my-4"/>
              <p>
                Untuk panduan penggunaan situs web selengkapnya dapat dilihat pada link berikut ini :
              </p>
            </div>
          </div>
        </div>
    </div>
    </section>

    <section>
    <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="img/03.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 order-lg-1"> 
            <div class="p-5">
              <h2 class="display-4">Let there be rock!</h2>
              <hr class="divider my-4"/>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
            </div>
          </div>
        </div>
    </div>
    </section> -->
    
    <!-- Card -->
    <!-- <div class="row text-center justify-content-center">
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src="{{ asset('assets/img/afdhal-n-unsplash.jpg') }}" alt="">
          <div class="card-body">
            <h4 class="card-title">Masjid</h4>
            <p class="card-text">{{ $jmlMasjid }} masjid dengan {{ $jmlPengurus }} pengurus terdaftar pada situs kami</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Find Out More!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src="{{ asset('assets/img/jamaah.png') }}" alt="Jamaah">
          <div class="card-body">
            <h4 class="card-title">Jamaah</h4>
            <p class="card-text">{{ $jmlJamaah }} jamaah telah bergabung bersama kami</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Find Out More!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Card title</h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Find Out More!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card h-100">
          <div width="500" height="325">
            <i class="fas fa-money-bill-wave-alt"></i>
          </div>
          <div class="card-body">
            <h4 class="card-title">Card title</h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Find Out More!</a>
          </div>
        </div>
      </div> -->
    <!--/Card-->
    </div>
    <!-- /.row -->
    
    
    
  
  
@endsection

<!-- Footer -->
