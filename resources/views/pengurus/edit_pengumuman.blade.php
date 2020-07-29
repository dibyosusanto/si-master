@extends('pengurus.master')
@section('content')    
    <div class="mt-4">
        <form action="{{ route('pengurus.update_pengumuman', $announcement->id_announcement) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="font-weight-bold">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $announcement->judul }}">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Isi</label>
                <textarea id="konten" class="form-control" name="konten" class="form-control">{{ $announcement->isi }}</textarea>
            </div>
            <div class="form-group text-right">
                <a href="{{ route('pengurus.list_pengumuman') }}" class="btn btn-outline-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
                <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
@endsection