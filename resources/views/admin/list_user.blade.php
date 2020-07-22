@extends('admin.master')
@section('content')
    <div class="my-4">
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                </tr>
                    
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($users as $user)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $user->email}}</td>
                    <td>
                        @if($user->role == 2)
                            @if(!empty($user->pengurus))
                                {{ $user->pengurus->nama_pengurus ?? '' }}
                            @else
                                <span class="badge badge-warning">Belum melengkapi profil</span>
                            @endif
                        @elseif($user->role == 3)
                            @if(!empty($user->jamaah_web))
                                {{ $user->jamaah_web->nama_jamaah ?? '' }}
                            @else
                                <span class="badge badge-warning">Belum melengkapi profil</span>
                            @endif
                        @else
                            {{ 'Admin' }}
                        @endif
                    </td>
                    <td>{{ $user->jenis_akses->nama_role }}</td>
                    <td>{{ date('d/m/Y h:i:s', strtotime($user->created_at)) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
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