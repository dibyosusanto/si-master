@extends('layouts.master')
@section('title')
    <title>Frequently Asked Question</title>
@endsection
@section('content')
    <div id="accordion" class="m-3">
        <div class="card">
            <div class="card-header bg-dark" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Bagaimana cara mendaftar sebagai pengurus masjid?
                    </button>
                </h5>
            </div>
            
            
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <ol type="a">
                        <li>
                            Jika masjid anda belum terdaftar : 
                            <ol>
                                <li>Klik Sign Up</li>
                                <li>Pilih Daftar Sebagai Pengurus</li>
                                <li>Pada pesan konfirmasi yang berisi "Apakah masjid anda sudah terdaftar?", pilih Belum</li>
                                <li>Isi Form Tambah Data Masjid dengan <span class="font-weight-bold"> benar, lengkap dan jelas </span> </li>
                                <li>Klik Simpan dan tunggu data masjid anda divalidasi oleh admin web, jika sudah divalidasi akan dikabarkan melalui No. Telepon yang diisikan pada form</li>
                                <li>Jika data masjid sudah divalidasi, silahkan ikuti langkah seperti pada poin b</li>
                            </ol>
                        </li>
                        <br>
                        <li>
                            Jika masjid anda sudah terdaftar : 
                            <ol>
                                <li>Klik Sign Up</li>
                                <li>Pilih Daftar Sebagai Pengurus</li>
                                <li>Pada pesan konfirmasi yang berisi "Apakah masjid anda sudah terdaftar?", pilih Sudah</li>
                                <li>Pada form Register, isikan email, password dan konfirmasi password. Kemudian klik Register. Pastikan email yang digunakan adalah email aktif</li>
                                <li>Selanjutnya anda akan dialihkan ke halaman login, login dengan email dan password yang telah didaftarkan</li>
                                <li>Lengkapi profil dan verifikasi email</li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-dark" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Bagaimana cara mendaftar sebagai jamaah?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <ol>
                        <li>Klik Sign Up</li>
                        <li>Pilih Daftar Seabgai Jamaah</li>
                        <li>Pada form Register, isikan email, password dan konfirmasi password. Kemudian klik Register. Pastikan email yang digunakan adalah email aktif</li>
                        <li>Selanjutnya anda akan dialihkan ke halaman login, login dengan email dan password yang telah didaftarkan</li>
                        <li>Lengkapi profil dan verifikasi email</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-dark" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Bagaimana cara jamaah melakukan transaksi infaq?
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <ol>
                        <li>Login dengan email dan password yang terdaftar</li>
                        <li>Pilih menu Infaq, kemudian klik Semua</li>
                        <li>Klik Tambah Data</li>
                        <li>Isi form Tambah Data Infaq dengan benar, lengkap dan jelas. Pastikan masjid yang dipilih dan bukti yang dicantumkan sudah benar</li>
                        <li>Klik Save</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-dark" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Bagaimana cara jamaah melakukan transaksi zakat fitrah?
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    <ol>
                        <li>Login dengan email dan password yang terdaftar</li>
                        <li>Pilih menu Zakat, kemudian klik Semua</li>
                        <li>Klik Tambah Data</li>
                        <li>Isi form Tambah Data Infaq dengan benar, lengkap dan jelas. Pastikan masjid yang dipilih dan bukti yang dicantumkan sudah benar</li>
                        <li>Klik Save</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection