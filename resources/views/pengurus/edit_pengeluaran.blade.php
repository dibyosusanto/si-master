@extends('pengurus.master')
@section('content')
    <form action="{{ route('pengurus.update_pengeluaran', $pengeluaran->id_pengeluaran) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card mt-4">
            <div class="card-header bg-dark text-light">
                Pengeluaran {{ date('d/m/Y', strtotime($pengeluaran->tgl_pengeluaran)) }}
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Tanggal Pengeluaran</label>
                        <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_pengeluaran" value="{{ $pengeluaran->tgl_pengeluaran }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Nominal</label>
                        <input type="text" class="form-control" name="nominal" value="{{ $pengeluaran->nominal }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" value="{{ $pengeluaran->keterangan }}">
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('pengurus.pengeluaran') }}" class="btn btn-outline-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
                <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
    
    
@endsection