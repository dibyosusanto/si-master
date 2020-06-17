@extends('layouts.admin')
@section('title')
    <title>Input Data Masjid</title>
@endsection
@section('content')
    @if(session('success'))
            <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('masjid.update', $masjid->id_masjid) }}" method="post">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama Masjid</td>
                <td><input type="text" name="nama_masjid" placeholder="Masukkan nama masjid" value="{{ $masjid->nama_masjid }}" autofocus required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" placeholder="Masukkan alamat masjid" value="{{ $masjid->alamat }}" required></td>
            </tr>
            <tr>
                <td>No Rekening</td>
                <td><input type="text" name="no_rekening" placeholder="Masukkan no. rekening masjid" value="{{ $masjid->no_rekening }}" required> </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Update</button></td>
            </tr>
        </table>

    </form>
@endsection