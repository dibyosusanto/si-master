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
    <form method="post" action="{{ route('pengurus.updateProfile', Auth::user()->id) }}">
        @method('PUT')
        @csrf
        <h2> {{ $pengurus->nama_pengurus }} </h2>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama_pengurus" value="{{ $pengurus->nama_pengurus }}" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold">No.HP</label>
                <input type="text" name="no_hp" value="{{ $pengurus->no_hp }}" onkeypress="return hanyaAngka(event)" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Alamat</label>
            <input type="text" name="alamat" value="{{ $pengurus->alamat }}" required>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <p>{{ $user->email }}</p>
        </div>
        <!-- <div class="form-group">
            <label class="font-weight-bold">Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Konfirmasi Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan konfirmasi password">
        </div> -->
        <button type="button" data-toggle="modal" data-target="#konfirmasi" class="btn btn-primary btn-block">Simpan</button>
        <div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda ingin menyimpan perubahan?
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="#" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
    </div>
    </form>
    
@endsection