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
   <div class="navbar">
   <nav>
      <ul>
        <!-- <li><a class="logo" href="#"><img src="../../../public/logo/logo.png" width="90px" height="25px"></a></li> -->
        <li><a class="logo" href="{{ route('home') }}"><img alt="SI-MASTER" src="{{ asset('logo/logo.png') }}" width="90px" height="25px"></a></li>
        <li><a class="menubar" href="{{ route('home') }}">BERANDA</a></li>
        <li><a class="menubar" href="{{ route('masjid.index') }}">MASJID</a></li>
        <li><a class="menubar" href="#">INFAQ</a></li>
        <li><a class="menubar" href="#">ZAKAT FITRAH</a></li>
        <li><a class="keluar" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                LOGOUT
        </a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>  
    </ul>
    </nav>
   </div>

   <div class="container">
        @yield('content')
   </div>

   <div class="footer">
        <center> SI-MASTER || SISTEM INFORMASI MASJID TERPADU </center>
   </div>
</body>
</html>