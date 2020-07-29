@extends('layouts.master')
@section('title')
    <title> Daftar Sebagai </title>
@endsection
@section('content')
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('status') }}
        </div>
    @endif        
    <div class="row justify-content-center my-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Daftar </div>
                <div class="card-body">
                    <div class="row justify-content-around ">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Daftar Sebagai Pengurus </button>
                        
                        <a class="btn btn-primary" href="{{ route('jamaah_web.register') }}"> Daftar Sebagai Jamaah </a>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <!--- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah masjid anda sudah terdaftar?
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" data-toggle="modal" data-target="#input_masjid">Belum</a>
                <a class="btn btn-primary" href="{{ route('pengurus.register') }}">Sudah</a>
            </div>
            </div>
        </div>
    </div>
    <!--/ Modal -->

    <div id="input_masjid" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Tambah Data Masjid</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('index.input_masjid') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Nama Masjid</label>
                                <input type="text" name="nama_masjid" class="form-control @error('nama_masjid') is-invalid @enderror" value="{{ old('nama_masjid') }}" placeholder="Masukkan nama masjid">
                                @error('nama_masjid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">No. Rekening</label>
                                <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" onkeypress="return hanyaAngka(event)" value="{{ old('no_rekening') }}" placeholder="Masukkan no. rekening" >
                                @error('no_rekening')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">No. Telepon</label>
                            <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" name="no_tlp" value="{{ old('no_tlp') }}" placeholder="Masukkan No. Telepon" onkeypress="return hanyaAngka(event)" maxlength="15">
                            @error('no_tlp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                    <button class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal Insert -->
@endsection