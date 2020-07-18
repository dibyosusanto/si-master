@extends('pengurus.master')
@section('content')
    <form action="{{ route('pengurus.update_infaq_masjid', $infaq->id_infaq) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ 'Data Infaq ' . $infaq->jamaah_masjid->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($infaq->tgl_infaq))  }}</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nominal</label>
                    <input type="text" name="nominal" class="form-control" value="{{ ($infaq->nominal) }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Jamaah</label>
                    <select name="id_jamaah" class="form-control">                    
                        @foreach($jamaah_masjid as $jamaah)
                            @if($jamaah->id_jamaah == $infaq->id_jamaah)
                                <option value="{{ $infaq->id_jamaah }}" selected>{{ $infaq->jamaah_masjid->nama_jamaah }}</option>
                            @else
                                <option value="{{ $jamaah->id_jamaah }}">{{ $jamaah->nama_jamaah }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Tanggal Infaq</label>
                    <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_infaq" value="{{ $infaq->tgl_infaq }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Diinput/Diubah Oleh</label>
                    <select name="id_pengurus" class="form-control">                    
                        @foreach($pengurus_masjid as $pengurus)
                            @if($pengurus->id_pengurus == $infaq->id_pengurus)
                                <option value="{{ $infaq->id_pengurus }}" selected>{{ $infaq->pengurus->nama_pengurus }}</option>
                            @else
                                <option value="{{ $pengurus->id_pengurus }}">{{ $pengurus->nama_pengurus }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Keterangan</label>
                <input type="text" name="keterangan" value="{{ $infaq->keterangan }}">
            </div>
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-outline-primary" href="{{ route('pengurus.infaq_masjid') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
        </div>
    </div>
    </form>
@endsection