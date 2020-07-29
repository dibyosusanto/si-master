@extends('pengurus.master')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>    
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card mb-4">
                <div class="card-body text-primary">
                    <label class="font-weight-bold">Total Jamaah</label>
                    <p class="text-right">{{ $jmlJamaahMjd }}</p>
                </div>
                <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('pengurus.lihatJamaah') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-primary mb-4">
                <div class="card-body">
                <label class="font-weight-bold">Infaq Belum divalidasi</label>
                    <p class="text-right"> {{ $jml_infaq_web }}</p>
                </div>
                <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('pengurus.infaq_web_belum_valid') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-primary mb-4">
                <div class="card-body">
                    <label class="font-weight-bold">Zakat Belum Divalidasi</label>
                    <p class="text-right">{{ $jml_zakat_web }}</p>
                </div>
                <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-primary mb-4">
                <div class="card-body">
                    <label class="font-weight-bold">Total Saldo</label> 
                    <p class="text-right">{{ 'Rp. ' . number_format($masjid->infaq_masjid->sum('nominal') + $masjid->infaq_web->sum('nominal') - $masjid->pengeluaran->sum('nominal')) ?? '' }}</p>
                </div>
                <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="m-2">
        <p class="font-weight-bold"><i class="fas fa-bullhorn"></i> Berita Terkini</p>
    </div>
    @foreach($announcements as $announcement)
    <div class="card mt-3 mb-3">
        <div class="card-header bg-light text-dark">
            <h3>{{ $announcement->judul }}</h3>
        </div>
        <div class="card-body">
            {!! strip_tags(substr($announcement->isi, 0, 100))  !!} ...
            <p class="text-right"><a href="{{ route('pengurus.detail_pengumuman', $announcement->id_announcement) }}" class="btn btn-primary">Selengkapnya</a></p>
        </div>
    </div>
    @endforeach
    <nav>
    <ul class="pagination justify-content-end"> <span style="color: #ff0000;"></span>
        <li class="page-item">
            {{ $announcements->links() }}
        </li>    
    </ul>
    </nav>
@endsection