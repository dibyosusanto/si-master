@extends('pengurus.master')
@section('content')
    <div class="my-4">
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                    <th>#</th>
                    <th>Tanggal Zakat</th>
                    <th>Nominal</th>
                    <th>Jamaah</th>
                    <th>Bukti Zakat</th>
                    <th>Keterangan</th>
                    <th>Status Validasi</th>
                    <th>Validasi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($zakat_web_all as $zakat_web)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d/m/Y', strtotime($zakat_web->tgl_zakat)) }}</td>
                    <td class="text-right">{{ number_format($zakat_web->nominal )}}</td>
                    <td>{{ $zakat_web->jamaah_web->nama_jamaah }} </td>
                    <td>
                        <img src="{{ asset('storage/bukti_zakat_web/'. $zakat_web->bukti_zakat) }}" width="100px" height="100px">
                        <a class="badge badge-info" href="{{ route('pengurus.bukti_zakat', $zakat_web->id_zakat) }}">Lihat</a></td>
                    <td>
                        @if($zakat_web->keterangan == null )
                            <p> - </p>
                        @else
                            <p> {{ $zakat_web->keterangan }} </p>
                        @endif
                    </td>
                    <td>
                        @if($zakat_web->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </td>
                    <td>
                       @if($zakat_web->status_validasi == 0)
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
                    <td colspan="4" class="font-weight-bold">Total Zakat Yang Sudah Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_zakat_v->total_zakat) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Zakat Yang Belum Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_zakat->total_zakat) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Zakat Keseluruhan</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_zakat->total_zakat + $sum_zakat_v->total_zakat) }}</td>
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
                    <form method="post" action="{{ route('pengurus.validasi_zakat', $zakat_web->id_zakat) }}">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Validasi</button>
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