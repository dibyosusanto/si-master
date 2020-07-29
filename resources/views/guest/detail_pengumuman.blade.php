@extends('layouts.master')

@section('content')
<hr class="divider">
<div class="card mt-3 mb-3">
    <div class="card-header bg-light text-dark">
        <h3>{{ $announcement->judul }}</h3>
    </div>
    <div class="card-body">
        {!! $announcement->isi !!}
    </div>
    <div class="card-footer text-right">
        <a href="{{ route('index') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection