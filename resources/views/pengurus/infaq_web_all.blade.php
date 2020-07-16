@extends('pengurus.master')
@section('content')
    <div class="my-4">
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
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark">
                    <th>#</th>
                    <th>Tanggal Infaq</th>
                    <th>Nominal</th>
                    <th>Jamaah</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($infaq_web_all as $infaq_web)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $infaq_web->tgl_infaq }}</td>
                    <td>{{ number_format($infaq_web->nominal )}}</td>
                    <td>{{ $infaq_web->jamaah_web->nama_jamaah }} </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>
Detail</a> |
                        <a class="btn btn-info btn-sm" href="#"> <i class="fas fa-pen    "></i> Edit</a> |
                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm"> <i class="fa fa-minus-circle" aria-hidden="true"></i> Hapus </button>
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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