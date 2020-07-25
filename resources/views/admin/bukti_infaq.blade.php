@extends('admin.master')
@section('content')
	<a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.infaq_web') }}"><i class="fas fa-arrow-left"></i>Kembali</a>
	<div class="card">
		<div class="card-header bg-dark text-light">
			<h3> {{ 'Bukti Infaq ' .  $bukti->jamaah_web->nama_jamaah . ' - ' . date('d/m/Y', strtotime($bukti->tgl_infaq)) }} </h3>
		</div>
		<div class="card-body">
			<h6>{{ 'ID Infaq ' .  $bukti->masjid->nama_masjid . ' #' . $bukti->id_infaq }}</h6>
			<img src="{{ asset('storage/bukti_infaq_web/' . $bukti->bukti_infaq) }}" class="img-fluid">
		</div>
	</div>
@endsection
