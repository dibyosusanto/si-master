@extends('pengurus.master')
@section('content')
    <div class="card my-4">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">{{ 'Data Zakat Fitrah ' . $detail_zakat_masjid->jamaah_masjid->nama_jamaah . ' - ' . date('d/m/Y' , strtotime($detail_zakat_masjid->tgl_zakat))  }}</h5>
        </div>
        <form action="{{ route('pengurus.update_zakat_masjid', $detail_zakat_masjid->id_zakat) }}" name="zakat" id="zakat" method="post">
        @csrf
        @method('PUT')
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Nama Jamaah</label>
                        <select name="id_jamaah" class="form-control">
                        @foreach($jamaah_masjid as $jamaah)
                            @if($jamaah->id_jamaah == $detail_zakat_masjid->id_jamaah)
                                <option value="{{ $detail_zakat_masjid->id_jamaah }}" selected> {{ $detail_zakat_masjid->jamaah_masjid->nama_jamaah }}</option>
                            @else
                                <option value="{{ $jamaah->id_jamaah }}">{{ $jamaah->nama_jamaah }}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Tanggal zakat</label>
                        <input type="date" id="#datepicker" class="form-control datepicker" name="tgl_zakat" value="{{ $detail_zakat_masjid->tgl_zakat }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Jenis Zakat</label>
                        <select name="jenis" class="form-control" id="jenis">
                            @if($detail_zakat_masjid->jenis == '1')
                                <option value="1" id="jenis" selected>{{ 'Beras' }}</option>
                                <option value="2" id="jenis">{{ 'Uang' }}</option>
                            @else
                                <option selected value="2" id="jenis">{{ 'Uang' }}</option>
                                <option value="1" id="jenis">{{ 'Beras' }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Jumlah Muzakki</label>
                        <input type="text" name="jml_muzakki" id="jml_muzakki" class="form-control" value="{{ $detail_zakat_masjid->jml_muzakki }}" onkeypress="return hanyaAngka (event)" onchange="Calculate()" onblur="stopCalculate()">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="banyaknya" class="font-weight-bold">Jumlah yang harus dibayar</label>
                        <input type="text" name="banyaknya" id="banyaknya" class="form-control" onload="tampilNilai()" onkeypress="return hanyaAngka (event)" onchange="Calculate()" onblur="stopCalculate()" value="{{ $detail_zakat_masjid->banyaknya }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Keterangan</label>
                        <input type="text" name="keterangan" value="{{ $detail_zakat_masjid->keterangan }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">Diinput Oleh</label>
                        <p> {{ $detail_zakat_masjid->pengurus->nama_pengurus }} </p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right text-light">
                <a class="btn btn-outline-primary" href="{{ route('pengurus.zakat_masjid') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali </a>
                <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </div>
        </form>
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

            function tampilkanNilai(){
                document.zakat.banyaknya.value = parseFloat(1000);
            }
        </script>
        <script>
            function tampilNilai(){
                document.zakat.banyaknya.value = parseFloat({{ $detail_zakat_masjid->banyaknya }});
            }
        </script>
@endsection