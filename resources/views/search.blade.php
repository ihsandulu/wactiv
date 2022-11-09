

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
    </style>
@endsection
@section('container')
{{-- @dd($posts) --}}

<div class="container mt-5">
    
    @foreach ($posts as $post)
    <div class="row">
        <div class="col-md-6 sisi-kiri">          
            <img src="{{ url("/images/product/product.png") }}" class="img img-thumbnail"/>
            @can('admin')
           adsf
            @endcan
        </div>
        <div class="col-md-6 sisi-kanan">
            <div class="row">
                <h1 class="mb-4">Product</h1>
                <h2 class="mb-3">{{ $post->product_name }}</h2>
                <div class="col-md-12">{{ $post->product_description }}</div>
            </div>
        </div>
    </div> 
    @endforeach
       <div class="d-flex justify-content-end">{{ $posts->links() }}</div>
</div>
<div class="fixed row p-0">
        <div class="col-md-6 p-0  page-left">
        </div>
        <div class="col-md-6  p-0 page-right">
        </div>
</div>
@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection