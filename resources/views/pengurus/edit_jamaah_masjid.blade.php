@extends('pengurus.master')

@section('content')
    <form action="{{ route('jamaah_masjid.update', $jamaah_masjid->id_jamaah) }}" method="post">
    @csrf
    @method('PUT')
        <div class="card my-4">
            <div class="card-header bg-dark text-light">
                <h5 class="card-title">{{ $jamaah_masjid->nama_jamaah }}</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="text-bold" for="nama_jamaah">Nama</label>
                        <input type="text" name="nama_jamaah" class="form-control" value="{{ $jamaah_masjid->nama_jamaah }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ $jamaah_masjid->no_hp }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value=" {{ $jamaah_masjid->alamat }} ">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="#datepicker" class="form-control datepicker" name="tanggal_lahir" value="{{ $jamaah_masjid->tgl_lahir }}">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                            @if($jamaah_masjid->jenis_kelamin == 'L')
                                <option value="L" selected>{{ 'Laki - Laki' }}</option>
                                <option value="P">{{ 'Perempuan' }}</option>
                            @else
                                <option selected value="P">{{ 'Perempuan' }}</option>
                                <option value="L">{{ 'Laki - Laki' }}</option>
                            @endif
                    </select>
                </div>
            </div>
            <div class="card-footer text-right text-light">
                <a class="btn btn-secondary" href="{{ route('pengurus.lihatJamaah') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
                <button type="submit" class="btn btn-primary"> <i class="fa fa-check" aria-hidden="true"></i> Update</button>
            </div>
        </div>
    </form>
@endsection