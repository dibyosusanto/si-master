@extends('jamaah_web.master')
@section('content')
<div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ 'Data Zakat Fitrah ' . $detail_zakat->jamaah_web->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($detail_zakat->tgl_zakat))  }}</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Jamaah</label>
                    <p> {{ $detail_zakat->jamaah_web->nama_jamaah }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal zakat</label>
                    <p> {{ date('d/m/Y', strtotime($detail_zakat->tgl_zakat)) }} </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Keterangan</label>
                    @if($detail_zakat->keterangan == null )
                        <p> - </p>
                    @else
                        <p> {{ $detail_zakat->keterangan }} </p>
                    @endif
                </div>
                
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Banyaknya</label>
                    <p>{{ 'Rp. ' . number_format($detail_zakat->nominal) }}</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Status Validasi</label>
                    @if($detail_zakat->status_validasi == 0)
                        <br/><p class="badge badge-warning">Belum divalidasi</p>
                    @else
                        <br/><p class="badge badge-success">Sudah divalidasi</p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Divalidasi Oleh</label>
                    <p> {{ $detail_zakat->pengurus->nama_pengurus ?? 'Belum divalidasi'  }} </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Jumlah Muzakki</label>
                    <p> {{ $detail_zakat->jml_muzakki }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Muzakki</label>
                    @php $i=1; @endphp
                    @foreach($detail_zakat->muzakki_web as $muzakki)
                        <p>{{ $i++ . '. ' . $muzakki->nama_muzakki }}</p>
                    @endforeach
                </div> 
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Bukti Zakat</label>
                <p> <img src="{{ asset('storage/bukti_zakat_web/' . $detail_zakat->bukti_zakat) }}" width="200px" height="200px"> </p>
            </div>
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-primary" href="{{ route('jamaah_web.zakat') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
        </div>
    </div>
@endsection