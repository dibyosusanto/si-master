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