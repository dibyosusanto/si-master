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
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($infaq_web_valid as $infaq_valid)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $infaq_valid->tgl_infaq }}</td>
                    <td>{{ number_format($infaq_valid->nominal )}}</td>
                    <td>{{ $infaq_valid->jamaah_web->nama_jamaah }} </td>
                    <td>
                        <img src="{{ asset('storage/bukti_infaq_web/'. $infaq_valid->bukti_infaq) }}" width="100px" height="100px">
                        <a class="badge badge-info" href="{{ route('pengurus.bukti_infaq', $infaq_valid->id_infaq) }}">Lihat</a></td>
                    <td>
                        @if($infaq_valid->keterangan == null )
                            <p> - </p>
                        @else
                            <p> {{ $infaq_valid->keterangan }} </p>
                        @endif
                    </td>
                    <td>
                        @if($infaq_valid->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
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
            </tfoot>
        </table>
    </div>

@endsection