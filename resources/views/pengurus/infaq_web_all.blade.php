@extends('pengurus.master')
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
                    <th>Tanggal Infaq</th>
                    <th>Nominal</th>
                    <th>Jamaah</th>
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
                    <td>
                        @if($infaq_web->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </td>
                    <td class="text-center">
                       @if($infaq_web->status_validasi == 0)
                       <form method="post" action="{{ route('pengurus.validasiInfaq', $infaq_web->id_infaq) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary"><i class="fas fa-check"></i> Validasi</button>
                            <a href="{{ route('pengurus.detail_infaq_web', $infaq_web->id_infaq) }}" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i> Detail</a>
                            <a href="{{ route('pengurus.edit_infaq_web', $infaq_web->id_infaq) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                        @else
                            <a href="{{ route('pengurus.detail_infaq_web', $infaq_web->id_infaq) }}" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i> Detail</a>
                            <a href="{{ route('pengurus.edit_infaq_web', $infaq_web->id_infaq) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                        </form>
                        @endif
                        
                    </td> 
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Infaq Yang Sudah Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_infaq_v->total_infaq) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Infaq Yang Belum Validasi</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_infaq->total_infaq) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Infaq Keseluruhan</td>
                    <td class="font-weight-bold text-center">Rp. </td>
                    <td colspan="3" class="font-weight-bold text-right">{{ number_format($sum_infaq->total_infaq + $sum_infaq_v->total_infaq) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    
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