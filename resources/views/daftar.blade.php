@extends('layouts.master')
@section('title')
    <title> Daftar Sebagai </title>
@endsection
@section('content')
        
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
                <a class="btn btn-secondary" href="#" data-dismiss="modal">Belum</a>
                <a class="btn btn-primary" href="{{ route('pengurus.register') }}">Sudah</a>
            </div>
            </div>
        </div>
    </div>

@endsection