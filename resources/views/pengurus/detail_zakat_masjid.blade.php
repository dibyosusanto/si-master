@extends('pengurus.master')
@section('content')
    <div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ 'Data Zakat Fitrah ' . $detail_zakat_masjid->jamaah_masjid->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($detail_zakat_masjid->tgl_zakat))  }}</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Jamaah</label>
                    <p> {{ $detail_zakat_masjid->jamaah_masjid->nama_jamaah }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal zakat</label>
                    <p> {{ date('d/m/Y', strtotime($detail_zakat_masjid->tgl_zakat)) }} </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Jenis Zakat</label>
                    @if($detail_zakat_masjid->jenis == 1)
                        <p>Beras</p>
                    @else
                        <p>Uang</p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Banyaknya</label>
                    @if($detail_zakat_masjid->jenis == 1)
                        <p>{{ $detail_zakat_masjid->banyaknya . ' liter' }}</p>
                    @else
                        <p>{{ 'Rp. ' . number_format($detail_zakat_masjid->banyaknya) }}</p>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Keterangan</label>
                    @if($detail_zakat_masjid->keterangan == null )
                        <p> - </p>
                    @else
                        <p> {{ $detail_zakat_masjid->keterangan }} </p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Diinput Oleh</label>
                    <p> {{ $detail_zakat_masjid->pengurus->nama_pengurus }} </p>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Nama Muzakki</label>
                @php $i=1; @endphp
                @foreach($detail_zakat_masjid->muzakki_masjid as $muzakki)
                    <p>{{ $i++ . '. ' . $muzakki->nama_muzakki }}</p>
                @endforeach
            </div> 
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-primary" href="{{ route('pengurus.zakat_masjid') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
        </div>
    </div>
@endsection