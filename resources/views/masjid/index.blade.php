@extends('layouts.admin')
@section('title')
    <title>Data Masjid</title>
@endsection
@section('content')
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <div>
        <a href="{{ route('masjid.create') }}">Tambah Data</a>
    </div>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama Masjid</th>
            <th>Alamat Masjid</th>
            <th>No. Rekening</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; ?>
        @foreach($masjid as $val)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $val->nama_masjid }}</td>
            <td>{{ $val->alamat }}</td>
            <td>{{ $val->no_rekening }}</td>
            <td>
                <form action="{{ route('masjid.destroy', $val->id_masjid) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('masjid.show', $val->id_masjid) }}">Detail</a> |
                    <a href="{{ route('masjid.edit', $val->id_masjid) }}">Edit</a> |
                    <button> Hapus </button>
                </form>
            </td>
            
        </tr>
        @endforeach
    </table>
    {!! $masjid->links() !!}
@endsection