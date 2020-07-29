@extends('pengurus.master')
@section('content')
    <div class="my-4">
        <div class="my-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert-jamaah"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah Data </button>
        </div>
        @if(session('status'))
            <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
        @endif
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                    <th>#</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Diinput Oleh</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($pengeluaran_masjids as $pengeluaran_masjid)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d/m/Y', strtotime($pengeluaran_masjid->tgl_pengeluaran)) }}</td>
                    <td class="text-right">{{ number_format($pengeluaran_masjid->nominal )}}</td>
                    <td>{{ $pengeluaran_masjid->keterangan }}</td>
                    <td>{{ $pengeluaran_masjid->pengurus->nama_pengurus }}</td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="{{ route('pengurus.edit_pengeluaran', $pengeluaran_masjid->id_pengeluaran ) }}"> <i class="fas fa-pen"></i> Edit</a>
                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i>Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Insert -->            
        <!-- Modal -->
        <div class="modal fade" id="insert-jamaah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Pengeluaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{ route('pengurus.input_pengeluaran') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tgl_infaq">Tanggal Pengeluaran</label>
                                    <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_pengeluaran" placeholder="Masukkan Tanggal Pengeluaran">
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label for="nominal">Nominal</label>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control" name="nominal" placeholder="Masukkan Nominal">
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close    "></i> Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <!--/ Modal Insert -->
    
    <!-- Modal Delete-->
    <form action="{{ route('pengurus.delete_pengeluaran', $pengeluaran_masjid->id_pengeluaran ?? '') }}" method="post">
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
                        <p>Apakah anda yakin ingin menghapus data?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/ Modal Delete -->
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