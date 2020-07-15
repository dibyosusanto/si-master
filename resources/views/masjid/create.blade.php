@extends('layouts.admin')
@section('title')
    <title>Input Data Masjid</title>
@endsection
@section('content')
    @if(session('success'))
            <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('masjid.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama_masjid">Nama Masjid</label>
            <input type="text" name="nama_masjid" class="form-control" placeholder="Masukkan nama masjid" autofocus required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Masjid</label>
            <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat masjid" required>
        </div>
        <div class="form-group">
            <label for="no_rekening">No. Rekening</label>
            <input type="text" name="no_rekening" class="form-control" placeholder="Masukkan no. rekening masjid" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary my-4 btn-block">Simpan</button>
        </div>
        
    </form>
@endsection