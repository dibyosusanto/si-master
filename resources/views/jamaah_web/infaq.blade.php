@extends('jamaah_web.master')
@section('content')
    <div class="my-4">
        <div class="my-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert-jamaah"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                Infaq Baru 
            </button>
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
        @elseif(session('input'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('input') }}
            </div>
        @endif
        <script>
          $(".alert").alert();
        </script>
        <table id="infaq" class="table table-hover table-striped">
            <thead class="thead-dark">
                    <th>#</th>
                    <th>Tanggal Infaq</th>
                    <th>Nominal</th>
                    <th>Masjid</th>
                    <th>Opsi</th>
            </thead>
                
            <tbody>
                <?php $no=1; ?>
                @foreach($infaq_web as $iw)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d F Y', strtotime($iw->tgl_infaq)) }}</td>
                    <td class="text-right">{{ number_format($iw->nominal) }}</td>
                    <td>{{ $iw->masjid->nama_masjid }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('jamaah_web.detail_infaq', $iw->id_infaq) }}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
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
                                <h5 class="modal-title">Tambah Data Infaq</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{ route('jamaah_web.inputInfaq') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                <label for="tgl_infaq">Tanggal Infaq</label>
                                <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_infaq">
                            </div>
                            <div class="form-group">
                                <label for="bukti_infaq">Bukti Infaq</label>
                                <input type="file" class="form-control" name="bukti_infaq">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan (jika perlu)">
                            </div>
                            <div class="form-group mb-0">
                                <label for="nominal">Nominal</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" name="nominal" placeholder="Masukkan Nominal">
                            </div>
                            
                            <div class="form-group">
                                <label for="id_masjid">Masjid</label>
                                <select class="form-control" name="id_masjid">
                                    <option selected>--Pilih salah satu--</option>
                                    @foreach($masjid as $m)
                                        <option value="{{ $m->id_masjid }}"> {{ $m->nama_masjid . ' - ' . $m->no_rekening }} </option>
                                    @endforeach
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