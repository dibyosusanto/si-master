@extends('pengurus.master')
@section('content')
    <div class="card my-4">
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
                    <p> {{ 'Rp. ' .number_format($infaq_web->nominal) }} </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal Infaq</label>
                    <p> {{ date('d/m/Y', strtotime($infaq_web->tgl_infaq)) }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Status Validasi</label>
                    @if($infaq_web->status_validasi == 1)
                        <br/><span class="badge badge-pill badge-success">Sudah divalidasi</span>
                    @else
                        <br/><span class="badge badge-pill badge-success">Belum divalidasi</span>
                    @endif
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
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Divalidasi Oleh</label>
                    @if($infaq_web->status_validasi == 1)
                        @if(!empty($infaq_web->id_pengurus))
                            <p>{{ $infaq_web->pengurus->nama_pengurus }}</p>
                        @else
                            <p>Admin SI-MASTER</p>
                        @endif
                    @else
                        <p> - </p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Bukti Infaq</label>
                <br><img src="{{ asset('storage/bukti_infaq_web/' . $infaq_web->bukti_infaq) }}" height=70% width="70%">
            </div>
            
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-primary" href="{{ route('pengurus.infaq_web_all') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
        </div>
    </div>
@endsection