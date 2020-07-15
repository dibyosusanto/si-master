@extends('pengurus.master')

@section('content')
    @foreach($jamaah_masjid as $jamaah)
    <div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ $jamaah->nama_jamaah }}</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="text-bold" for="nama_jamaah">Nama</label>
                    <div class="form-control"> {{ $jamaah->nama_jamaah }} </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="no_hp">No HP</label>
                    <div class="form-control"> {{ $jamaah->no_hp }} </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <div class="form-control"> {{ $jamaah->alamat }} </div>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <div class="form-control"> {{ date('d F Y', strtotime($jamaah->tgl_lahir)) }} </div>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <div class="form-control"> 
                    @if($jamaah->jenis_kelamin == 'L')
                        {{ 'Laki - Laki' }}
                    @else
                        {{ 'Perempuan' }}
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-primary" href="{{ route('pengurus.lihatJamaah') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
        </div>
    </div>
    
    
    @endforeach
@endsection