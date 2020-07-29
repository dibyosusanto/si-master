@extends('pengurus.master')
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
        <a class="btn btn-primary mb-2" href="{{ route('pengurus.input_pengumuman') }}"><i class="fas fa-plus-circle"></i> Tambah Data</a>
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Author</th>
                    <th>Status Publish</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($announcements as $announcement)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $announcement->judul }}</td>
                    <td>{!! strip_tags(substr($announcement->isi, 0, 50))  . ' ... ' !!}</td>
                    <td>{{ $announcement->pengurus->nama_pengurus ?? 'Admin' }}</td>
                    <td class="text-center">
                        @if($announcement->publish == 1)
                            <span class="badge badge-pill badge-success">Sudah dipublish</span>
                        @else
                            <span class="badge badge-pill badge-warning">Belum dipublish</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pengurus.detail_pengumuman', $announcement->id_announcement) }}" class="btn btn-sm btn-info"> <i class="fas fa-info-circle"></i>Detail</a>
                        <a href="{{ route('pengurus.edit_pengumuman', $announcement->id_announcement) }}" class="btn btn-sm btn-info"> <i class="fas fa-pencil-alt"></i> Edit</a>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt"></i> Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Moodal Delete -->
    <form action="{{ route('pengurus.destroy_pengumuman', $announcement->id_announcement ?? '') }}" method="post">
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