
@extends('templates/main')
@section('container')
<div class="container mt-5 mb-5" align="center">
    <h1>Selamat Datang {{Auth()->user()->user_name}}</h1>
    <div class="row">
        <div class="col-md-4 p-5"><a href="{{ url('/layanan') }}" class="btn btn-success btn-block">Layanan</a></div>
        <div class="col-md-4 p-5"><a href="{{ url('/transaction') }}" class="btn btn-success btn-block">Transaksi</a></div>
        <div class="col-md-4 p-5"><a href="{{ url('/tagihan') }}" class="btn btn-success btn-block">Tagihan</a></div>
    </div>
</div>    
@endsection