@extends('jamaah_web.master')
@section('content')
    <div class="my-4">
        <div class="my-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert-jamaah"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                Infaq Baru 
            </button>
        </div>
        @if(session('hapus'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('hapus') }}
            </div>
        @elseif(session('edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('edit') }}
            </div>
        @elseif(session('tambah'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('tambah') }}
            </div>
        @endif
        <script>
          $(".alert").alert();
        </script>
        <table id="myTable" class="table table-active table-hover table-striped">
            <thead class="thead-dark">
                    <th>#</th>
                    <th>Tanggal Infaq</th>
                    <th>Keterangan</th>
                    <th>Bukti Infaq</th>
                    <th>Nominal<th>
                    <th>Status Validasi</th>
                    <th>Masjid</th>
                    <th>Opsi</th>
            </thead>
                <?php $no=1; ?>
            <tbody>
                @foreach($infaq_web as $iw)
                <tr>
                    <td>{{ $no++ }}
                    <td>{{ $iw->tgl_infaq }}</td>
                    <td>{{ $iw->keterangan }}</td>
                    <td>{{ $iw->bukti }}</td>
                    <td>{{ $iw->bominal }}</td>
                    <td>{{ $iw->status_validasi }}</td>
                    <td>{{ $iw->id_masjid }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('jamaah_masjid.show', $j->id_jamaah) }}"><i class="fa fa-info-circle" aria-hidden="true"></i>
Detail</a> |
                        <a class="btn btn-info btn-sm" href="{{ route('jamaah_masjid.edit', $j->id_jamaah) }}"> <i class="fas fa-pen    "></i> Edit</a> |
                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm"> <i class="fa fa-minus-circle" aria-hidden="true"></i> Hapus </button>
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
                                <h5 class="modal-title">Tambah Data Infaq</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{ route('jamaah_web.inputInfaq') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tgl_infaq">Tanggal Infaq</label>
                                <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_infaq">
                            </div>
                            <div class="form-group">
                                <label for="bukti_infaq">Bukti Infaq</label>
                                <input type="file" class="form-control" name="bukti_infaq">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan (jika perlu)">
                            </div>
                            <div class="form-group mb-0">
                                <label for="nominal">Nominal</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" name="nominal" placeholder="Masukkan Nominal">
                            </div>
                            
                            <div class="form-group">
                                <label for="id_masjid">Masjid</label>
                                <select class="form-control" name="jenis_kelamin">
                                    <option selected>--Pilih salah satu--</option>
                                    @foreach($masjid as $m)
                                        <option value="{{ $m->id_masjid }}"> {{ $m->nama_masjid . ' - ' . $m->no_rekening }} </option>
                                    @endforeach
                                </select>
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
    <form action="#" method="post">
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