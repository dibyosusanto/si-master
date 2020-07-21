@extends('jamaah_web.master')
@section('content')
    <div class="my-4">
        <div class="my-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert-jamaah"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                Zakat Baru 
            </button>
        </div>
        @if(session('tambah'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('tambah') }}
            </div>
        @endif
        <table id="infaq" class="table table-hover table-striped">
            <thead class="thead-dark">
                    <th>#</th>
                    <th>Tanggal Zakat</th>
                    <th>Keterangan</th>
                    <th>Jumlah Muzakki</th>
                    <th>Nominal</th>
                    <th>Nama Masjid</th>
                    <th>Bukti Zakat</th>
                    <th>Status Validasi</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($zakat_web as $zakat)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d F Y', strtotime($zakat->tgl_zakat)) }}</td>
                    <td>{{ $zakat->keterangan }}</td>
                    <td>{{ $zakat->jml_muzakki }}</td>
                    <td>{{ $zakat->nominal }}</td>
                    <td>{{ $zakat->masjid->nama_masjid }}</td>
                    <td>
                        <img src="{{ asset('storage/bukti_zakat_web/' . $zakat->bukti_zakat) }}" width="100px" height="100px">
                    </td>
                    <td>
                        @if($zakat->status_validasi == 0)
                            <p class="badge badge-warning">Belum divalidasi</p>
                        @else
                            <p class="badge badge-success">Sudah divalidasi</p>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('jamaah_web.detail_zakat', $zakat->id_zakat) }}"><i class="fa fa-info-circle" aria-hidden="true"></i>Detail</a>
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
                            <h5 class="modal-title">Tambah Data Zakat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{ route('jamaah_web.input_zakat') }}" method="post" name="zakat" id="zakat" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="tgl_zakat" class="font-weight-bold">Tanggal Zakat</label>
                                <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_zakat">
                            </div>
                            <div class="form-group">
                                <label for="bukti_infaq">Bukti Zakat</label>
                                <input type="file" class="form-control" name="bukti_zakat">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jml_muzakki" class="font-weight-bold">Jumlah Muzakki</label>
                                    <input type="text" name="jml_muzakki" id="jml_muzakki" class="form-control" onkeypress="return hanyaAngka (event)" onchange="Calculate()" onblur="stopCalculate()">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="banyaknya" class="font-weight-bold">Jumlah yang harus dibayar</label>
                                    <input type="text" name="banyaknya" id="banyaknya" class="form-control" onkeypress="return hanyaAngka (event)" onchange="Calculate()" onblur="stopCalculate()" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan (jika perlu)">
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
    <script type="text/javascript">
        function startCalculate(){
            interval = setInterval("Calculate()", 10);	
        }
        
        function Calculate(){
            var bayar=40000;
            var a = parseInt(document.zakat.jml_muzakki.value);
            if(isNaN(a))a=0;
            document.zakat.banyaknya.value = parseFloat(a*bayar);
        }
        
        function stopCalculate(){
            interval = clearInterval();	
        }
    </script>
@endsection