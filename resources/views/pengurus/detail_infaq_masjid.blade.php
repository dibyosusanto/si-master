@extends('pengurus.master')
@section('content')
    <div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ 'Data Infaq ' . $detail_infaq->jamaah_masjid->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($detail_infaq->tgl_infaq))  }}</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nominal</label>
                    <p> {{ 'Rp. ' .number_format($detail_infaq->nominal) }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Jamaah</label>
                    <p> {{ $detail_infaq->jamaah_masjid->nama_jamaah }} </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal Infaq</label>
                    <p> {{ date('d/m/Y', strtotime($detail_infaq->tgl_infaq)) }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Diinput Oleh</label>
                    <p> {{ $detail_infaq->pengurus->nama_pengurus }} </p>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Keterangan</label>
                @if($detail_infaq->keterangan == null )
                    <p> - </p>
                @else
                    <p> {{ $detail_infaq->keterangan }} </p>
                @endif
            </div>
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-primary" href="{{ route('pengurus.infaq_masjid') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
        </div>
    </div>
@endsection