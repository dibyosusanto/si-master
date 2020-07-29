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
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#insert_masjid"><i class="fas fa-plus-circle"></i>Tambah Data</button>
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nama Masjid</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>No Rekening</th>
                    <th>Status Validasi</th>
                    <th>Opsi</th>
                </tr>
                    
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($masjids as $masjid)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $masjid->nama_masjid}}</td>
                    <td>{{ $masjid->alamat }}</td>
                    <td>{{ $masjid->no_tlp }}</td>
                    <td>{{ $masjid->no_rekening }}</td>
                    <td>
                        @if($masjid->status_validasi == 1)
                            <span class="badge badge-pill badge-success">Sudah Divalidasi</span>
                        @else
                            <span class="badge badge-pill badge-warning">Belum Divalidasi</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.detail_masjid', $masjid->id_masjid) }}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                        <a href="{{ route('admin.edit_masjid', $masjid->id_masjid) }}" class="btn btn-info btn-sm"><i class="fas fa-pen"></i> Edit</a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal"> <i class="fas fa-trash"></i> Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Insert -->
    <div id="insert_masjid" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Tambah Data Masjid</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.input_masjid') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Nama Masjid</label>
                                <input type="text" name="nama_masjid" class="form-control @error('nama_masjid') is-invalid @enderror" value="{{ old('nama_masjid') }}" placeholder="Masukkan nama masjid">
                                @error('nama_masjid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">No. Rekening</label>
                                <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" onkeypress="return hanyaAngka(event)" value="{{ old('no_rekening') }}" placeholder="Masukkan no. rekening">
                                @error('no_rekening')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">No. Telepon</label>
                            <input type="text" name="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror" onkeypress="return hanyaAngka(event)" value="{{ old('no_rekening') }}" placeholder="Masukkan No. Telepon" maxlength="15">
                            @error('no_tlp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                    <button class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal Insert -->

    <!-- Moodal Delete -->
    <form action="{{ route('admin.destroy_masjid', $masjid->id_masjid) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Konfirmasi</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-weight-bold text-danger"> <i class="fas fa-exclamation-triangle"></i> Data yang sudah dihapus tidak dapat dipulihkan <i class="fas fa-exclamation-triangle"></i> </p> 
                        <p>Apakah anda yakin ingin menghapus data?</p> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-window-close" aria-hidden="true"></i> Batal</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/ Modal Delete-->
    
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