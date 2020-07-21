@extends('pengurus.master')
@section('content')
	
	<a class="btn btn-primary mt-3 mb-3" href="{{ route('pengurus.zakat_web_all') }}"><i class="fas fa-arrow-left"></i>Kembali</a>
	<div class="card">
		<div class="card-header bg-dark text-light">
			<h3> {{ 'Bukti zakat ' .  $bukti->jamaah_web->nama_jamaah . ' - ' . date('d/m/Y', strtotime($bukti->tgl_zakat)) }} </h3>
		</div>
		<div class="card-body">
			<h6>{{ 'ID Zakat ' .  $bukti->masjid->nama_masjid . ' #' . $bukti->id_zakat }}</h6>
			<img src="{{ asset('storage/bukti_zakat_web/' . $bukti->bukti_zakat) }}" class="img-fluid">
		</div>
	</div>
@endsection
