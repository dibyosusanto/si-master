@extends('admin.master')
@section('content')
    <div class="my-4">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
        @endif
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#insert_jamaah_web"><i class="fas fa-plus-circle"></i> Tambah Data</button>
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($jamaahs as $jamaah)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $jamaah->email}}</td>
                    <td>
                        @if(!empty($jamaah->jamaah_web))
                            {{ $jamaah->jamaah_web->nama_jamaah ?? '' }}
                        @else
                            <span class="badge badge-warning">Belum melengkapi profil</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($jamaah->email_verified_at))
                            {{ date('d/m/Y h:i:s', strtotime($jamaah->email_verified_at)) }}
                        @else
                            <span class="badge badge-warning">Belum verifikasi</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if(!empty($jamaah->jamaah_web))
                            <a class="btn btn-sm btn-info" href="{{ route('admin.detail_jamaah_web', $jamaah->id) }}"> <i class="fas fa-info-circle"></i>Detail</a>
                        @else
                            <span class="badge badge-warning">Belum melengkapi profil</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Opsi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <!-- Modal Insert -->
    <div id="insert_jamaah_web" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Tambah Jamaah Web</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.input_jamaah_web') }}" method="post">
                @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('') }}" placeholder="Masukkan email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan konfirmasi password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Nama Jamaah</label>
                                <input type="text" name="nama_jamaah" class="form-control @error('nama_jamaah') is-invalid @enderror" value="{{ old('nama_jamaah') }}" placeholder="Masukkan nama jamaah">
                                @error('nama_jamaah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Tanggal Lahir</label>
                                <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir">
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">No.HP</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Masukkan No. HP" onkeypress="return hanyaAngka(event)" maxlength="13" minlength="11">
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="" selected>--PIlih Jenis Kelamin--</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Masukkan Alamat">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"> <i class="fas fa-window-close"></i> Batal</button>
                        <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- /Modal Insert -->
    
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