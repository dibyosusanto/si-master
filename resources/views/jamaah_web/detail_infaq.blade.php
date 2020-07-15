@extends('jamaah_web.master')
@section('content')
    @foreach($detail_infaq as $detail)
        {{$detail->tgl_infaq}}
    @endforeach
@endsection