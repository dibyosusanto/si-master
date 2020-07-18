@extends('jamaah_web.master')
@section('content')
    @foreach($detail_infaqs as $detail_infaq)
        <div class="card my-4">
            <div class="card-header bg-dark text-light">
                <h5 class="font-weight-bold">{{ 'Detail Infaq ' .$detail_infaq->jamaah_web->nama_jamaah. ' - ' . $detail_infaq->masjid->nama_masjid . ' - ' . date('d/m/Y', strtotime($detail_infaq->tgl_infaq)) }}</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label class="font-weight-bold">Nominal</label>
                        <p>{{ 'Rp. ' . number_format($detail_infaq->nominal) }}</p>
                    </div>
                    <div class="form-group col-6">
                        <label class="font-weight-bold">Tanggal Infaq</label>
                        <p> {{ date('d/m/Y', strtotime($detail_infaq->tgl_infaq)) }} </p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label class="font-weight-bold">Masjid</label>
                        <p> {{ $detail_infaq->masjid->nama_masjid . ' - ' . $detail_infaq->masjid->alamat . ' - ' . $detail_infaq->masjid->no_rekening }} </p>
                    </div>
                    <div class="form-group col-6">
                        <label class="font-weight-bold">Status Validasi</label>
                        @if($detail_infaq->status_validasi == 0)
                            <br/><p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <br/><p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Keterangan</label>
                        @if($detail_infaq->keterangan == null )
                            <p> - </p>
                        @else
                            <p> {{ $detail_infaq->keterangan }} </p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Divalidasi Oleh</label>
                        <p>{{ $detail_infaq->pengurus->nama_pengurus ?? 'Belum divalidasi' }}</p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="font-weight-bold">Bukti Infaq</label>
                    <br/><img src="{{ asset('storage/bukti_infaq_web/' . $detail_infaq->bukti_infaq) }}" width="100px" height="100px"/>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('jamaah_web.lihatInfaq') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
            </div>
        </div>
        
    @endforeach    
@endsection