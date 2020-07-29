@extends('jamaah_web.master')
@section('content')
<div class="card mt-4 mb-4">
    <div class="card-header bg-dark text-light">
        <h5>{{ 'Data ' . $masjid->nama_masjid . ' per tanggal ' . date('d/m/Y h:i:s', strtotime(\Carbon\Carbon::now())) }}</h5>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Nama Masjid</label>
                <p>{{ $masjid->nama_masjid }}</p>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Alamat</label>
                <p>{{ $masjid->alamat }}</p>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">No. Rekening</label>
                <p>{{ $masjid->no_rekening }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Jumlah Pengurus</label>
                <p>{{ $masjid->pengurus->count() }}</p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Pengurus</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Hp</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->pengurus as $pengurus)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pengurus->nama_pengurus }}</td>
                            <td>{{ $pengurus->alamat }}</td>
                            <td>{{ $pengurus->no_hp }}</td>
                            <td>{{ $pengurus->user->email }}</td>
                        </tr>
                    </tbody>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Jumlah Jamaah</label>
                <p>{{ $masjid->jamaah->count() }}</p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Jamaah</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->jamaah as $jamaah)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $jamaah->nama_jamaah }}</td>
                            <td>
                                @if($jamaah->jenis_kelamin == 'L')
                                    {{ 'Laki-Laki' }}
                                @else
                                    {{ 'Perempuan' }}
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($jamaah->tgl_lahir)->diff(\Carbon\Carbon::now())->format('%y') }}</td>
                        </tr>
                    </tbody>              
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Jumlah Infaq Masjid</label>
                <p>{{ $masjid->infaq_masjid->count() . ' infaq dengan total Rp. ' . number_format($masjid->infaq_masjid->sum('nominal')) }}</p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Infaq Masjid</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tgl Infaq</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->infaq_masjid as $infaq_masjid)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $infaq_masjid->jamaah_masjid->nama_jamaah }}</td>
                            <td>{{ date('d/m/Y', strtotime($infaq_masjid->tgl_infaq)) }}</td>
                            <td>{{ 'Rp. ' . number_format($infaq_masjid->nominal) }}</td>  
                        </tr>
                    </tbody>              
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Jumlah Infaq Web</label>
                <p>{{ $masjid->infaq_web->count() . ' infaq dengan total Rp. ' . number_format($masjid->infaq_web->sum('nominal')) }}</p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Infaq Web</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tgl Infaq</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->infaq_web as $infaq_web)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $infaq_web->jamaah_web->nama_jamaah }}</td>
                            <td>{{ date('d/m/Y', strtotime($infaq_web->tgl_infaq)) }}</td>
                            <td>{{ 'Rp. ' . number_format($infaq_web->nominal) }}</td>  
                        </tr>
                    </tbody>              
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Jumlah Zakat Web</label>
                <p>{{ $masjid->zakat_web->count() . ' zakat dengan total Rp. ' . number_format($masjid->zakat_web->sum('nominal')) }}</p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Zakat Web</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tgl Zakat</th>
                            <th>Nominal</th>
                            <th>Muzakki</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->zakat_web as $zakat_web)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $zakat_web->jamaah_web->nama_jamaah }}</td>
                            <td>{{ date('d/m/Y', strtotime($zakat_web->tgl_zakat)) }}</td>
                            <td>{{ 'Rp. ' . number_format($zakat_web->nominal) }}</td>  
                            <td>{{ $zakat_web->muzakki_web->count() }}</td>
                        </tr>
                    </tbody>              
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Jumlah Zakat Masjid</label>
                <p>{{ $masjid->zakat_masjid->count() . ' zakat dengan total : ' }}</p>
                <p>
                    @foreach($masjid->zakat_masjid as $zakat_masjid)
                        @if($zakat_masjid->jenis == 1)
                            {{ $zakat_masjid->banyaknya . ' Liter Beras dan Uang'}}
                        @else
                            {{ 'Rp. ' . number_format($zakat_masjid->banyaknya) }}
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Zakat Masjid</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tgl Zakat</th>
                            <th>Nominal</th>
                            <th>Muzakki</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->zakat_masjid as $zakat_masjid)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $zakat_masjid->jamaah_masjid->nama_jamaah }}</td>
                            <td>{{ date('d/m/Y', strtotime($zakat_masjid->tgl_zakat)) }}</td>
                            <td>
                            @if($zakat_masjid->jenis == 1)
                                {{ $zakat_masjid->banyaknya . ' Liter'}}
                            @else
                                {{ 'Rp. ' . number_format($zakat_masjid->banyaknya) }}
                            @endif
                            </td>
                            <td>{{ $zakat_masjid->muzakki_masjid->count() }}</td>
                        </tr>
                    </tbody>              
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Total Pengeluaran</label>
                <p>{{ $masjid->pengeluaran->count() . ' pengeluaran dengan total Rp.  ' . number_format($masjid->pengeluaran->sum('nominal')) }}</p>
            </div>
            <div class="form-group col-md-8">
                <label class="font-weight-bold">Daftar Pengeluaran</label>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl Pengeluaran</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                @php $no=1 @endphp
                @forelse($masjid->pengeluaran as $pengeluaran)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('d/m/Y', strtotime($pengeluaran->tgl_pengeluaran)) }}</td>
                            <td>{{ 'Rp. ' . number_format($pengeluaran->nominal) }}</td>
                            <td>{{ $pengeluaran->keterangan }}</td>
                        </tr>
                    </tbody>              
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
                </table>         
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Saldo Akhir</label>
            </div>
            <div class="form-group col-md-6 font-weight-bold">
                <p class="text text-primary">{{ 'Rp. ' . number_format($masjid->infaq_masjid->sum('nominal') + $masjid->infaq_web->sum('nominal') - $masjid->pengeluaran->sum('nominal')) }}</p>
            </div>
        </div>
        
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('jamaah_web.index') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection
