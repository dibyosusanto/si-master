@extends('admin.master')
@section('content')
    <div class="my-4">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#insert_admin"> <i class="fas fa-plus-circle"></i>Tambah Data</button>
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                </tr>
                    
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($users as $user)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ date('d/m/Y h:i:s', strtotime($user->created_at)) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal Insert -->
    <div id="insert_admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Tambah Data Masjid</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.input_masjid') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Nama Masjid</label>
                                <input type="text" name="nama_masjid" class="form-control" value="{{ old('nama_masjid') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">No. Rekening</label>
                                <input type="text" name="no_rekening" class="form-control" onkeypress="return hanyaAngka(event)" value="{{ old('no_rekening') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}">
                        </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                    <button class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal Insert -->

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