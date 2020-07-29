@extends('admin.master')
@section('content')
    <div class="my-4">
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
                    <th>Tanggal Zakat</th>
                    <th>Nominal</th>
                    <th>Jamaah</th>
                    <th>Masjid</th>
                    <th>Status Validasi</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($zakat_web_all as $zakat_web)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d/m/Y', strtotime($zakat_web->tgl_zakat)) }}</td>
                    <td class="text-right">{{ number_format($zakat_web->nominal )}}</td>
                    <td>{{ $zakat_web->jamaah_web->nama_jamaah }} </td>
                    <td>{{ $zakat_web->masjid->nama_masjid }}</td>
                    <td>
                        @if($zakat_web->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </td>
                    <td class="text-center">
                       @if($zakat_web->status_validasi == 0)
                       <form method="post" action="{{ route('admin.validasi_zakat', $zakat_web->id_zakat) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Validasi</button>
                            <a href="{{ route('admin.detail_zakat_web', $zakat_web->id_zakat) }}" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i> Detail</a>
                            <a href="{{ route('admin.edit_zakat_web', $zakat_web->id_zakat) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                        @else
                            <a href="{{ route('admin.detail_zakat_web', $zakat_web->id_zakat) }}" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i> Detail</a>
                            <a href="{{ route('admin.edit_zakat_web', $zakat_web->id_zakat) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                        </form>
                        @endif
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt"></i> Hapus</button>
                        
                    </td> 
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Zakat Yang Sudah Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_zakat_v) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Zakat Yang Belum Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_zakat) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Zakat Keseluruhan</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_zakat + $sum_zakat_v) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal Validasi -->
    <div class="modal fade" id="validasi_infaq" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Bukti Zakat</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Validasi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('admin.validasi_zakat', $zakat_web->id_zakat ?? '') }}">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Validasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal Validasi -->
    <!-- Moodal Delete -->
    <form action="{{ route('admin.delete_zakat_web', $zakat_web->id_zakat ?? '') }}" method="post">
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