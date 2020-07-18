@extends('pengurus.master')
@section('content')
    <div class="my-4">
        <div class="my-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert-jamaah"><i class="fa fa-plus-circle" aria-hidden="true"></i>
 Tambah Data </button>
        </div>
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
        <table id="myTable" class="table table-active table-hover table-striped">
            <thead class="thead-dark">
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>No Hp.</th>
                    <th>Jenis Kelamin</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                @foreach($jamaah as $j)
                <tr>
                    <td>{{ $j->nama_jamaah }}</td>
                    <td>{{ $j->alamat }}</td>
                    <td>{{ $j->tgl_lahir }}</td>
                    <td>{{ $j->no_hp }}</td>
                    <td>
                        @if($j->jenis_kelamin == 'L')
                            {{ 'Laki-Laki' }}
                        @else
                            {{ 'Perempuan' }}
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('jamaah_masjid.show', $j->id_jamaah) }}"><i class="fa fa-info-circle"></i>Detail</a> |
                        <a class="btn btn-info btn-sm" href="{{ route('jamaah_masjid.edit', $j->id_jamaah) }}"> <i class="fas fa-pen"></i> Edit</a> |
                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm"> <i class="fa fa-minus-circle" aria-hidden="true"></i> Hapus </button>
                    </td> 
                </tr>           
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Insert -->            
        <!-- Modal -->
        <div class="modal fade" id="insert-jamaah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Jamaah</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{ route('pengurus.input_jamaah') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_jamaah">Nama</label>
                                    <input type="text" class="form-control" name="nama_jamaah" placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no_hp">No HP</label>
                                    <input type="number" class="form-control" name="no_hp" placeholder="Masukkan No.HP">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" id="#datepicker" class="form-control datepicker" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin">
                                    <option selected>--Pilih salah satu--</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close    "></i> Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    <!--/ Modal Insert -->

    <!-- Modal Delete-->
    <form action="{{ route('jamaah_masjid.destroy', $j->id_jamaah ?? '') }}" method="post">
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