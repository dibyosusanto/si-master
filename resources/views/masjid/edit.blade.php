@extends('layouts.admin')
@section('title')
    <title>Edit Data Masjid</title>
@endsection
@section('content')
    <form action="{{ route('masjid.update', $masjid->id_masjid) }}" method="post" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="form-row justify-content-center">
            <div class="form-group col-sm-12">
                <label for="nama_masjid">Nama Masjid</label>
                <input type="text" name="nama_masjid" class="form-control" placeholder="Masukkan nama masjid" value="{{ $masjid->nama_masjid }}" autofocus required>
                <br/>
            </div>
            <div class="form-group col-sm-12">
                <label for="alamat">Alamat Masjid</label>
                <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat masjid" value="{{ $masjid->alamat }}" required>
                <br/>
            </div>
            <div class="form-group col-sm-12">
                <label for="no_rekening">No. Rekening</label>
                <input type="text" name="no_rekening" class="form-control" placeholder="Masukkan no. rekening masjid" value="{{ $masjid->no_rekening }}" required>
                <br/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
@endsection