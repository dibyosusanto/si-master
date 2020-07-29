@extends('pengurus.master')
@section('content')
    @if(session('status'))
        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('status') }}
        </div>
    @endif
    @if(session('alert'))
        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('alert') }}
        </div>
    @endif
    <form action="{{ route('pengurus.update_kata_sandi', Auth::user()->id) }}" method="post">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label class="font-weight-bold">Password Lama</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Password Baru</label>
                <input type="password" name="password_baru">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Konfirmasi Password Baru</label>
                <input type="password" name="konfir_password">
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">Ubah Password</button>
            </div>
    </form>
@endsection