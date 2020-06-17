@extends('layouts.admin')
@section('title')
    <title>Input Data Masjid</title>
@endsection
@section('content')
    @if(session('success'))
            <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('masjid.index') }}" method="post">
        @csrf
        <table>
            <tr>
                <td>Nama Masjid</td>
                <td><input type="text" name="nama_masjid" placeholder="Masukkan nama masjid" autofocus required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" placeholder="Masukkan alamat masjid" required></td>
            </tr>
            <tr>
                <td>No Rekening</td>
                <td><input type="text" name="no_rekening" placeholder="Masukkan no. rekening masjid" required> </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Simpan</button></td>
            </tr>
        </table>

    </form>
@endsection