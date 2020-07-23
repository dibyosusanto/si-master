@extends('admin.master')
@section('content')
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            <h3> {{ $jamaah->nama_jamaah . ' - ' .  \Carbon\Carbon::parse($jamaah->tgl_lahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }} </h3>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Jamaah</label>    
                    <p>{{ $jamaah->nama_jamaah }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Email</label>    
                    <p>{{ $jamaah->user->email }}</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal Lahir</label>    
                    <p>{{ date('d/m/Y', strtotime($jamaah->tgl_lahir)) }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">No. HP</label>    
                    <p>{{ $jamaah->no_hp }}</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Jenis Kelamin</label>    
                    @if($jamaah->jenis_kelamin == 'L')
                        <p>Laki - Laki</p>
                    @else
                        <p>Perempuan</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Alamat</label>    
                    <p>{{ $jamaah->alamat }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a class="btn btn-primary" href="{{ route('admin.list_jamaah_web') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
@endsection