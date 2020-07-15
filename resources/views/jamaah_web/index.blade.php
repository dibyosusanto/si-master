@extends('jamaah_web.master')
@section('content')
    <div class="jumbotron jumbotron-fluid my-4">
        <div class="container">
            <h1 class="display-3">Selamat Datang {{ $jamaah_web->nama_jamaah }}</h1>
            <p class="lead">Jumbo helper text</p>
            <hr class="my-2">
            <p>More info</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
            </p>
        </div>
    </div>
@endsection