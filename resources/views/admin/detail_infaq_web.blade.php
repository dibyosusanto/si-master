@extends('admin.master')
@section('content')
    <div class="card mt-4">
        <div class="card-header bg-dark text-light">
            <h3>Data Infaq {{ $infaq_web->jamaah_web->nama_jamaah . ' - ' . date('d/m/Y', strtotime($infaq_web->tgl_infaq)) . ' - ' . $infaq_web->masjid->nama_masjid }}</h3>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">ID Infaq</label>
                    <p>{{ $infaq_web->id_infaq }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Jamaah</label>
                    <p>{{ $infaq_web->jamaah_web->nama_jamaah }}</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Tanggal Infaq</label>
                    <p>{{date('d/m/Y', strtotime($infaq_web->tgl_infaq))}}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nominal</label>
                    <p>{{ 'Rp. ' . number_format($infaq_web->nominal) }}</p>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Masjid</label>
                    <p>{{ $infaq_web->masjid->nama_masjid }}</p>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Status Validasi</label>
                    @if($infaq_web->status_validasi == 1)
                        <br>
                        <div class="badge badge-success">Sudah divalidasi</div>
                    @else
                        <br>
                        <div class="badge badge-warning">Belum divalidasi</div>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Divalidasi oleh</label>
                    @if($infaq_web->status_validasi == 1)
                        @if($infaq_web->id_pengurus != null)
                            <p>{{ $infaq_web->pengurus->nama_pengurus }}</p>
                        @else
                            <p>Admin SI-MASTER</p>
                        @endif
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Keterangan</label>
                @if($infaq_web->keterangan != null)
                    <p>{{ $infaq_web->keterangan }}</p>
                @else
                    <p>-</p>
                @endif
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Bukti Infaq</label>
                <br>
                <img src="{{ asset('storage/bukti_infaq_web/'. $infaq_web->bukti_infaq) }}" width="100%" height="100%">
            </div>
        </div>
        <div class="card-footer text-right">
            <form action="{{ route('admin.validasi_infaq', $infaq_web->id_infaq) }}" method="post">
                @csrf
                @method('PUT')
                <a href="{{ route('admin.infaq_web') }}" class="btn btn-outline-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
                @if($infaq_web->status_validasi == 0)
                    <button class="btn btn-primary"> <i class="fas fa-save"></i> Validasi</button>
                @endif
            </form>
        </div>
    </div>
@endsection