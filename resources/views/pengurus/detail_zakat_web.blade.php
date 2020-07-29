@extends('pengurus.master')
@section('content')
    <div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ 'Data Zakat ' . $zakat_web->jamaah_web->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($zakat_web->tgl_zakat))  }}</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Jamaah</label>
                    <p> {{ $zakat_web->jamaah_web->nama_jamaah }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nominal</label>
                    <p> {{ 'Rp. ' .number_format($zakat_web->nominal) }} </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal Zakat</label>
                    <p> {{ date('d/m/Y', strtotime($zakat_web->tgl_zakat)) }} </p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Status Validasi</label>
                    @if($zakat_web->status_validasi == 1)
                        <br/><span class="badge badge-pill badge-success">Sudah divalidasi</span>
                    @else
                        <br/><span class="badge badge-pill badge-success">Belum divalidasi</span>
                    @endif
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Keterangan</label>
                    @if($zakat_web->keterangan == null )
                        <p> - </p>
                    @else
                        <p> {{ $zakat_web->keterangan }} </p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Divalidasi Oleh</label>
                    @if($zakat_web->status_validasi == 1)
                        @if(!empty($zakat_web->id_pengurus))
                            <p>{{ $zakat_web->pengurus->nama_pengurus }}</p>
                        @else
                            <p>Admin SI-MASTER</p>
                        @endif
                    @else
                        <p> - </p>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Jumlah Muzakki</label>
                    <p>{{ $zakat_web->jml_muzakki ?? '' }}</p>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Muzakki</label>
                    @foreach($zakat_web->muzakki_web as $muzakki)
                        <p>{{$muzakki->nama_muzakki}}</p>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Bukti Zakat</label>
                <br><img src="{{ asset('storage/bukti_zakat_web/' . $zakat_web->bukti_zakat) }}" height=70% width="70%">
            </div>
            
            
        </div>
        <div class="card-footer text-right text-light">
            <a class="btn btn-primary" href="{{ route('pengurus.zakat_web_all') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
        </div>
    </div>
@endsection