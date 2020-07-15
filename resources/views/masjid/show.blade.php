@extends('layouts.admin')
@section('title')
    <title>Data Masjid</title>
@endsection
@section('content')
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <div>
        
    </div>
    <table>
        @foreach($mosque as $dp)
        <tr>
            <td>Nama Masjid</td>
            <td><input type="text" name="nama_masjid" value="{{ $dp->nama_masjid }}" disabled></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat" value="{{ $dp->alamat }}" disabled></td>
        </tr>
        <tr>
            <td>No Rekening</td>
            <td><input type="text" name="no_rekening" value="{{ $dp->no_rekening }}" disabled> </td>
        </tr>
        @endforeach
        <tr>
            <td colspan=2> &nbsp; </td>
        </tr>
    </table>
    <span>Data Pengurus</span>
    <span>Jumlah Pengurus {{ $jmlPengurus }}</span>
    <table cellpadding=5>
        <thead>
            <th>Nama Pengurus</th>
            <th>No. Hp</th>
            <th>Alamat</th>
        </thead>
        @forelse($pengurus as $p)
        <tr>
            <td>{{ $p->nama_pengurus }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" align="center">Tidak ada data</td>
        </tr>
        @endforelse
    </table>
    <br/><br/>
    <span>Data Jamaah </span>
    <table cellpadding=5>
        <thead>
            <th>Nama Jamaah</td>
            <th>Alamat</th>
            <th>Tgl. Lahir</th>
            <th>No. Hp</th>
            <th>Jenis Kelamin</th>
        </thead>
        @forelse($jamaah as $j)
        <tr>
            <td>{{ $j->nama_jamaah }}</td>
            <td>{{ $j->alamat }}</td>
            <td>{{ $j->tgl_lahir }}</td>
            <td>{{ $j->no_hp }}</td>
            <td>{{ $j->jenis_kelamin }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" align="center">Tidak ada data</td>
        </tr>
        @endforelse
        <tr>
            <td><a href="{{ route('masjid.index') }}"> Kembali </a></td>
        </tr>
    </table>
@endsection