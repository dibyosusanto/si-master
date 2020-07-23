@extends('jamaah_web.master')
@section('title')
    <title>Data Jamaah</title>
@endsection
@section('content')
{{-- menampilkan error validasi --}}
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('lengkapi'))
        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('lengkapi') }}
        </div>
    @endif
    <form action="{{ route('jamaah_web.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama_jamaah">Nama Jamaah</label>
            <input type="text" name="nama_jamaah" class="form-control" value="{{ old('nama_jamaah') }}" placeholder="Masukkan nama jamaah" autofocus>
            @error('nama_jamaah')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat">No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No. HP" onkeypress="return hanyaAngka(event)" minlength="11" maxlength="13" value="{{ old('no_hp') }}">
            @error('no_hp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat" value="{{ old('alamat') }}">
            @error('alamat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
            @error('tgl_lahir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
                <option selected>--Pilih salah satu--</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary my-4 btn-block">Simpan</button>
        </div>
    </form>
    <script type="text/javascript">
        $(function(){
        $(".datepicker").datepicker({
            format: 'Y-m-d',
            autoclose: true,
            todayHighlight: true,
        });
        });
    </script>
@endsection