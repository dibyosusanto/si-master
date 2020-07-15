@extends('layouts.admin')

@section('title')
    <title> Halaman Admin </title>
@endsection

@section('content')

    <!-- Jumbotron Header -->
    <div class="container">
        <header class="jumbotron my-4">
            <h1 class="display-3">Selamat Datang {{ Auth::user()->id }}</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
        </header>
    </div>
@endsection
