@extends('admin.master')
@section('content')
    <div class="my-4">
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