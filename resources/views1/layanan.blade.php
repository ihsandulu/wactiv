
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
<hr/>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-6" >
            <h1 class="text-bold">Layanan</h1>
        </div>
        <div align="right" class="col-md-6 m-0"><a href="{{ url('/product') }}" class="btn btn-primary fa fa-plus"> Tambah Layanan</a></div>
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link categoryproduct active bg-greendark" onclick="activcategory(this)" aria-current="page" href="#">Semua</a>
        </li>
        <?php 
            $categorys = DB::table('category')->get();
        ?>
        @foreach ($categorys as $category)
        <li class="nav-item">
          <a class="nav-link categoryproduct" onclick="activcategory(this)" aria-current="page" href="#">{{ $category->category_name }}</a>
        </li>
        @endforeach
    </ul>
    <script>
        function activcategory(a){
            $('.categoryproduct').removeClass('active');
            $('.categoryproduct').removeClass('bg-greendark');
            $(a).addClass('active');
            $(a).addClass('bg-greendark');
        }
    </script>
    <div class="row">
        <?php $products = DB::table('tranprod')
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where("user_id",auth()->user()->id)
        // ->where("tranprod_active",TRUE)
        ->orderBy('product_name','asc')
        ->paginate(50);?>
        <div class="d-flex flex-row-reverse mt-1 col-md-12">{{ $products->links() }}</div>
        @foreach ($products as $product)
        <div class="col-md-2 p-1" >
            <div class="card p-3" >
                <img src="{{ url("/images/product/".$product->product_picture) }}" class="card-img-top" alt="{{ $product->product_name }}">
                <div class="card-body mt-4">
                    <h5 class="card-title text-center">{{ $product->product_name }}</h5>
                    <div class="d-grid gap-2">
                        <div align="center">Out of Date : <br/>{{ date("d M, Y",strtotime($product->tranprod_outdate)); }}</div>
                        <a href="{{ url("/layanandetail?id=".$product->tranprod_id) }}" class="btn btn-success btn-block">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
       <div class="d-flex flex-row-reverse mt-3 mb-5 col-md-12">{{ $products->links() }}</div>
    </div>
      
   
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