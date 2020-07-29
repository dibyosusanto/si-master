@extends('admin.master')
@section('content')
<h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>    
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light text-primary mb-4">
                <div class="card-body">
                    <label class="font-weight-bold">Total User</label>
                    <p class="text-right">{{ $jml_user }}</p>
                </div>
                <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                    <a class="small text-light stretched-link" href="{{ route('admin.list_user') }}">View Details</a>
                    <div class="small text-light"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light text-primary mb-4">
                <div class="card-body">
                <label class="font-weight-bold">Total Masjid</label>
                    <p class="text-right">{{ $jml_masjid }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-primary">
                    <a class="small text-white stretched-link" href="{{ route('admin.masjid') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light text-primary mb-4">
                <div class="card-body">
                    <label class="font-weight-bold">Total Transaksi Infaq</label> 
                    <p class="text-right">{{ $jml_infaq }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-primary text-white">
                    <a class="small text-white stretched-link" href="#" data-target="#collapsePages" data-toggle="collapse">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light text-primary mb-4">
                <div class="card-body">
                    <label class="font-weight-bold">Total Transaksi Zakat</label>
                    <p class="text-right">{{ $jml_zakat }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-primary">
                    <a class="small text-white stretched-link" href="#" data-target="#collapsePages2" data-toggle="collapse">View Details</a>
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
            <p class="text-right"><a href="{{ route('admin.detail_pengumuman', $announcement->id_announcement) }}" class="btn btn-primary">Selengkapnya</a></p>
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