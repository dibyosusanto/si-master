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
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Infaq Belum Divalidasi</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection