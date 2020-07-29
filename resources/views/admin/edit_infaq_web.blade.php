@extends('admin.master')
@section('content')
    <div class="card my-4">
        <form action="{{ route('admin.update_infaq_web', $infaq_web->id_infaq) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header bg-dark text-light">
                <h5 class="card-title">{{ 'Data Infaq ' . $infaq_web->jamaah_web->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($infaq_web->tgl_infaq))  }}</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Nama Jamaah</label>
                        <p> {{ $infaq_web->jamaah_web->nama_jamaah }} </p>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Nominal</label>
                        <input type="text" name="nominal" value="{{ $infaq_web->nominal }}" onkeypress="return hanyaAngka(event)">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Tanggal Infaq</label>
                        <p> {{ date('d/m/Y', strtotime($infaq_web->tgl_infaq)) }} </p>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Status Validasi</label>
                        <select name="status_validasi" class="form-control">
                        @if($infaq_web->status_validasi == 1)
                            <option value="1" selected>Sudah Validasi</option>
                            <option value="0">Belum Validasi</option>
                        @else
                            <option value="1" >Sudah Validasi</option>
                            <option value="0" selected>Belum Validasi</option>
                        @endif
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Keterangan</label>
                        @if($infaq_web->keterangan == null )
                            <p> - </p>
                        @else
                            <p> {{ $infaq_web->keterangan }} </p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Bukti Infaq</label>
                    <br><img src="{{ asset('storage/bukti_infaq_web/' . $infaq_web->bukti_infaq) }}" height=70% width="70%">
                </div>
            </div>
            <div class="card-footer text-right text-light">
                <a class="btn btn-outline-primary" href="{{ route('admin.infaq_web') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
                <button class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Simpan </button>
            </div>
        </form>
    </div>
        
        
@endsection