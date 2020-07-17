@extends('pengurus.master')
@section('content')
<div class="my-4">
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark">
                    <th>#</th>
                    <th>Tanggal Infaq</th>
                    <th>Nominal</th>
                    <th>Jamaah</th>
                    <th>Bukti Infaq</th>
                    <th>Keterangan</th>
                    <th>Status Validasi</th>
                    <th>Validasi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($infaq_web_belum_valid as $infaq_web)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $infaq_web->tgl_infaq }}</td>
                    <td>{{ number_format($infaq_web->nominal )}}</td>
                    <td>{{ $infaq_web->jamaah_web->nama_jamaah }} </td>
                    <td>
                        <img src="{{ asset('storage/bukti_infaq_web/'. $infaq_web->bukti_infaq) }}" width="100px" height="100px">
                        <a class="badge badge-info" data-target="#bukti_infaq" data-toggle="modal">Lihat</a></td>
                    <td>
                        @if($infaq_web->keterangan == null )
                            <p> - </p>
                        @else
                            <p> {{ $infaq_web->keterangan }} </p>
                        @endif
                    </td>
                    <td>
                        @if($infaq_web->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </td>
                    <td>
                       @if($infaq_web->status_validasi == 0)
                            <button class="btn btn-sm btn-primary" data-target="#validasi_infaq" data-toggle="modal"><i class="fas fa-check"></i> Validasi</button>
                        @else
                            <p class="text-secondary">Sudah divalidasi</p>
                        @endif
                    </td> 
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Infaq Yang Belum Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_infaq->total_infaq) }}</td>
                </tr>  
            </tfoot>
        </table>
    </div>

    <!-- Modal Bukti Infaq-->
        <div class="modal fade" id="bukti_infaq" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Bukti Infaq</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/bukti_infaq_web/' . $infaq_web->bukti_infaq) }}" width="100px">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!--/ Modal Bukti Infaq -->

    <!-- Modal Validasi -->
    <div class="modal fade" id="validasi_infaq" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Bukti Infaq</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-thumbnail" src="{{ asset('storage/bukti_infaq_web/' . $infaq_web->bukti_infaq) }}"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('pengurus.validasiInfaq', $infaq_web->id_infaq) }}">
                        @csrf
                        @method('PUT')
                        @if($infaq_web->status_validasi == 0)
                            <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Validasi</button>
                        @else
                            <p class="text-secondary">Sudah divalidasi</p>
                        @endif    
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