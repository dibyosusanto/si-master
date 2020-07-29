@extends('pengurus.master')
@section('content')
    <div class="mt-5">
        <form action="{{ route('pengurus.store_muzakki') }}" method="POST">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Lengkapi nama muzakki
        </div>
        @csrf
        @for($i = 1; $i <= $jml_muzakki; $i++)
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Muzakki ke {{ $i }}</label>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="nama_muzakki[]" class="form-control">
                </div>
            </div>
        @endfor
            <div class="form-group">
                <input type="hidden" name="id_zakat" value="{{ $id_zakat }}">
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection