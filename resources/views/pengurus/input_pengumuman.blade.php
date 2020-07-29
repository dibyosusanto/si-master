@extends('pengurus.master')
@section('content')    
    <div class="mt-4">
        <form action="{{ route('pengurus.store_pengumuman') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label class="font-weight-bold">Judul</label>
                <input type="text" name="judul" class="form-control">
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Isi</label>
                <textarea id="konten" class="form-control" name="konten" class="form-control"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="{{ route('pengurus.list_pengumuman') }}" class="btn btn-outline-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
                <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
        
        
    </div>
@endsection