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
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                    <th>#</th>
                    <th>Tanggal Infaq</th>
                    <th>Nominal</th>
                    <th>Jamaah</th>
                    <th>Masjid</th>
                    <th>Status Validasi</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($infaq_web_all as $infaq_web)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d/m/Y', strtotime($infaq_web->tgl_infaq)) }}</td>
                    <td class="text-right">{{ number_format($infaq_web->nominal )}}</td>
                    <td>{{ $infaq_web->jamaah_web->nama_jamaah }} </td>
                    <td>{{ $infaq_web->masjid->nama_masjid }}</td>
                    <td>
                        @if($infaq_web->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.detail_infaq_web', $infaq_web->id_infaq) }}" class="btn btn-info btn-sm"> <i class="fas fa-info-circle"></i> Detail</a>
                        <a href="{{ route('admin.edit_infaq_web', $infaq_web->id_infaq) }}" class="btn btn-info btn-sm"> <i class="fas fa-pen"></i> Edit</a> 
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_infaq"> <i class="fas fa-trash-alt"></i> Hapus</button>
                    </td> 
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Infaq Keseluruhan</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($infaq_web_all->sum('nominal')) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    
    <!-- Modal Validasi -->
    <div class="modal fade" id="delete_infaq" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Konfirmasi Penghapusan Infaq</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="font-weight-bold text-danger"> <i class="fas fa-exclamation-triangle"></i> Data yang sudah dihapus tidak dapat dipulihkan <i class="fas fa-exclamation-triangle"></i> </p> 
                    <p>Apakah anda yakin ingin menghapus data?</p> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="fas fa-window-close"></i> Batal</button>
                    <form method="post" action="{{ route('admin.destroy_infaq_web', $infaq_web->id_infaq) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal Validasi -->

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