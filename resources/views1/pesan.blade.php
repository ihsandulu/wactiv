
@extends('templates/main')

@section('header')
    <style>
        .img{width: 100%; height: auto;}
        .page-left{background-color:rgba(16, 167, 74, 0.1); opacity:0.1;}
        .fixed{
            padding: 0px;
            position: fixed !important; 
            left: 0px; 
            top: 0px; 
            z-index: -10; 
            padding: 0px;
            width: inherit;
            height: inherit;
        }
        .sisi-kiri{padding: 120px;}
        .sisi-kanan{padding: 120px;}
        .top-right{position: absolute; top:10px; right:10px; width:100px; height:auto;}
        .bahaya{color:red; font-size:20px;}
        .aman{color:green; font-size:15px;}
        .iframe{height:900px; overflow: hidden;}
        #keterangan{margin-top:50px;}
    </style>
@endsection
@section('container')


<hr/>
<div class="container mt-5">   
    <div class="row">       
        <div class="col-md-12 m-5 p-5 text-white rounded" style="background-color:#f0f0f0;">
            <h1>{{request()->get('title')}}</h1>
            <p style="color:#4c4f4d;">{{request()->get('pesan')}}</p>
            <a href="{{ url('/') }}" class="btn btn-success mt-3">Home</a>
        </div>
    </div>  
</div>
@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection