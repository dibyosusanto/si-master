@extends('pengurus.master')
@section('content')
    <div class="my-4">
        <div class="mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert-jamaah"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah Data </button>
        </div>
        @if(session('tambah'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('tambah') }}
            </div>
        @elseif(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
        @elseif(session('hapus'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('hapus') }}
            </div>
        @endif
        <table id="myTable" class="table table-active table-hover table-bordered table-striped">
            <thead class="thead-dark text-center">
                    <th>#</th>
                    <th>Tanggal Zakat</th>
                    <th>Jenis</th>
                    <th>Banyaknya</th>
                    <th>Nama Jamaah</th>
                    <th>Opsi</th>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($zakat_masjids as $zakat_masjid)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ date('d/m/Y', strtotime($zakat_masjid->tgl_zakat)) }}</td>
                    <td>
                        @if($zakat_masjid->jenis == 1)
                            Beras
                        @else
                            Uang
                        @endif
                    </td>
                    <td class="text-right">
                        @if($zakat_masjid->jenis == 1)
                            {{ $zakat_masjid->banyaknya . ' Liter'}}
                        @else
                            {{ 'Rp. ' . number_format($zakat_masjid->banyaknya) }}
                        @endif
                        
                    </td>
                    <td>{{ $zakat_masjid->jamaah_masjid->nama_jamaah }}</td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="{{ route('pengurus.detail_zakat_masjid', $zakat_masjid->id_zakat) }}"><i class="fa fa-info-circle"></i>Detail</a>
                        <a class="btn btn-info btn-sm" href="{{ route('pengurus.edit_zakat_masjid', $zakat_masjid->id_zakat) }}"> <i class="fas fa-pen"></i> Edit</a>
                        <button type="button" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i>Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-dark text-light table-borderless">
                <tr>
                    <td colspan="4">Total Zakat Uang</td>
                    <td class="text-right">Rp. </td>
                    <td class="text-right">
                        {{ number_format($zakat_uang) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4">Total Zakat Beras</td>
                    <td colspan="2" class="text-right">
                        {{ $zakat_beras }} Liter
                    </td>
                </tr>
            </tfoot>
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
                        <form action="{{ route('pengurus.input_zakat') }}" method="post" name="zakat" id="zakat">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tgl_zakat" class="font-weight-bold">Tanggal Zakat</label>
                                    <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_zakat">
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label for="jenis" class="font-weight-bold">Jenis Zakat</label>
                                    <select name="jenis" class="form-control" id="jenis">
                                        <option value="" selected>--Pilih Jenis Zakat--</option>
                                        <option value="1" id="jenis">Beras</option>
                                        <option value="2" id="jenis">Uang</option>
                                    </select>
                                </div>
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
                                <label for="id_jamaah" class="font-weight-bold">Nama Jamaah</label>
                                <select class="form-control" name="id_jamaah">
                                    <option selected>--Pilih salah satu--</option>
                                    @foreach($jamaah_masjid as $jamaah)
                                        <option value="{{ $jamaah->id_jamaah }}">{{ $jamaah->nama_jamaah . ' - ' . $jamaah->alamat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <!--/ Modal Insert -->
    
    <!-- Modal Delete-->
    <form action="{{ route('pengurus.delete_zakat_masjid', $zakat_masjid->id_zakat ?? '') }}" method="post">
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
    <script type="text/javascript">
        function startCalculate(){
            interval = setInterval("Calculate()", 10);	
        }
        
        function Calculate(){
            var x = document.zakat.jenis.value;
            
            if(x==1){
                var bayar=parseFloat(3.5);
            }else if(x==2){
                var bayar=40000;
            }
            var a = parseInt(document.zakat.jml_muzakki.value);
            if(isNaN(a))a=0;
            
            document.zakat.banyaknya.value = parseFloat(a*bayar);
        }
        
        function stopCalculate(){
            interval = clearInterval();	
        }
    </script>
@endsection