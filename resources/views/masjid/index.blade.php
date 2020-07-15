@extends('layouts.admin')
@section('title')
    <title>Data Masjid</title>
@endsection
@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('masjid.create') }}">Tambah Data</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <th>No.</th>
                <th>Nama Masjid</th>
                <th>Alamat Masjid</th>
                <th>No. Rekening</th>
                <th>Jumlah Pengurus</th>
                <th>Aksi</th>
                
            </thead>
            <?php $no=1; ?>
            @foreach($masjid as $val)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $val->nama_masjid }}</td>
                <td>{{ $val->alamat }}</td>
                <td>{{ $val->no_rekening }}</td>
                <td>
                    {{ $val->pengurus->count() }}
                </td>
                <td>
                    <form action="{{ route('masjid.destroy', $val->id_masjid) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-info" href="{{ route('masjid.show', $val->id_masjid) }}">Detail</a> |
                        <a class="btn btn-info" href="{{ route('masjid.edit', $val->id_masjid) }}">Edit</a> |
                        <button class="btn btn-danger"> Hapus </button>
                    </form>
                </td> 
            </tr>
            @endforeach
        </table>
    </div>
    {!! $masjid->links() !!}
@endsection