@extends('pengurus.master')

@section('content')
<hr class="divider">
<div class="card mt-3 mb-3">
    <div class="card-header bg-light text-dark">
        <h3>{{ $announcement->judul }}</h3>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-6">
                <i class="fa fa-calendar-alt" aria-hidden="true"></i> {{ date('d/m/Y H:i:s', strtotime($announcement->created_at)) }}    
            </div>
            <div class="col-md-6 text-right">
                <i class="fa fa-pencil-alt" aria-hidden="true"></i> Author : 
            @if(!empty($announcement->id_pengurus))
                {{ $announcement->pengurus->nama_pengurus }}    
            @else
                Admin SI-MASTER
            @endif
            </div>
        </div>
        {!! $announcement->isi !!}
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('pengurus.index') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection