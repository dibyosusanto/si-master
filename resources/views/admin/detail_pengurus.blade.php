@extends('admin.master')
@section('content')
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            <h3> {{ $pengurus->nama_pengurus }} </h3>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama pengurus</label>    
                    <p>{{ $pengurus->nama_pengurus }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Email</label>    
                    <p>{{ $pengurus->user->email }}</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">No. HP</label>    
                    <p>{{ $pengurus->no_hp }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Masjid</label>    
                    <p>{{ $pengurus->masjid->nama_masjid }}</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Jenis Kelamin</label>    
                    @if($pengurus->jenis_kelamin == 'L')
                        <p>Laki - Laki</p>
                    @else
                        <p>Perempuan</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Alamat</label>    
                    <p>{{ $pengurus->alamat }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a class="btn btn-primary" href="{{ route('admin.list_pengurus') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
@endsection