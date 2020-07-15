@extends('pengurus.master')
@section('title')
    <title>Data Pengurus</title>
@endsection
@section('content')
    @if(session('success'))
            <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('pengurus.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama_masjid">Nama Pengurus</label>
            <input type="text" name="nama_pengurus" class="form-control" placeholder="Masukkan nama pengurus" autofocus required>
        </div>
        <div class="form-group">
            <label for="alamat">No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No. HP" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat" required>
        </div>
        <div class="form-group">
            <label for="id_masjid">Masjid</label>
            <select id="id_masjid" name="id_masjid" class="form-control">
                <option selected>--Pilih Masjid--</option>
                @foreach($masjid as $mjd)
                <option value="{{ $mjd->id_masjid }}">{{ $mjd->nama_masjid }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary my-4 btn-block">Simpan</button>
        </div>
        
    </form>
@endsection