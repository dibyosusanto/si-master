@extends('jamaah_web.master')
@section('content')
    @if(session('status'))
        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('status') }}
        </div>
    @endif
    <form method="post" action="{{ route('jamaah_web.updateProfile', Auth::user()->id) }}">
        @method('PUT')
        @csrf
        <h2> {{ $jamaah_web->nama_jamaah }} </h2>
        <div class="row">
            <div class="form-group col-6">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama_jamaah" value="{{ $jamaah_web->nama_jamaah }}" required>
            </div>
            <div class="form-group col-6">
                <label class="font-weight-bold">No.HP</label>
                <input type="text" name="no_hp" value="{{ $jamaah_web->no_hp }}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Alamat</label>
            <input type="text" name="alamat" value="{{ $jamaah_web->alamat }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir" class="font-weight-bold">Tanggal Lahir</label>
            <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_lahir" value="{{ $jamaah_web->tgl_lahir }}">
        </div>
        <div class="form-group">
            <label for="jenis_kelamin" class="font-weight-bold">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                    @if($jamaah_web->jenis_kelamin == 'L')
                        <option value="L" selected>{{ 'Laki - Laki' }}</option>
                        <option value="P">{{ 'Perempuan' }}</option>
                    @else
                        <option selected value="P">{{ 'Perempuan' }}</option>
                        <option value="L">{{ 'Laki - Laki' }}</option>
                    @endif
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <p>{{ $jamaah_web->user->email }}</p>
        </div>
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