@extends('admin.master')
@section('content')
<div class="card mt-4">
    <div class="card-header bg-dark text-light">
        <h3>{{ 'Data ' . $masjid->nama_masjid }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.update_masjid', $masjid->id_masjid) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Masjid</label>
                    <input type="text" name="nama_masjid" class="form-control @error('nama_masjid') is-invalid @enderror" value="{{ old('nama_masjid') ?? $masjid->nama_masjid }}">
                    @error('nama_masjid')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">No. Rekening</label>
                    <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" onkeypress="return hanyaAngka(event)" value="{{ $masjid->no_rekening }}">
                    @error('no_rekening')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">No. Telepon</label>
                    <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" name="no_tlp" value="{{ $masjid->no_tlp }}" onkeypress="return hanyaAngka(event)" maxlength="15">
                    @error('no_tlp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Status Validasi</label>
                    <select name="status_validasi" class="form-control">
                        @if($masjid->status_validasi == 1)
                            <option value="1" selected>Sudah Validasi</option>
                            <option value="0"> Belum Validasi </option>
                        @else
                            <option value="0" selected> Belum Validasi </option>
                            <option value="1">Sudah Validasi</option>
                        @endif
                    </select>
                    @error('no_tlp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label class="font-weight-bold">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $masjid->alamat }}">
                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('admin.masjid') }}" class="btn btn-outline-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
        <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
        </form>  
    </div>
</div>

@endsection