
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
            <h1 class="text-bold">Documentation</h1>
        </div>
       <!--  <div align="right" class="col-md-6 m-0"><a href="{{ url('/product') }}" class="btn btn-primary fa fa-plus"> Tambah Layanan</a></div> -->
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link categoryproduct active bg-greendark" onclick="activcategory(this)" aria-current="page" href="<?=url("/documentations");?>">Semua</a>
        </li>
        <?php 
            $categorys = DB::table('category')->get();
        ?>
        @foreach ($categorys as $category)
        <li class="nav-item">
          <a id="c{{ $category->category_id }}" class="nav-link categoryproduct" onclick="activcategory(this)" aria-current="page" href="<?=url("/documentations?id=$category->category_id");?>">{{ $category->category_name }}</a>
        </li>
        @endforeach
    </ul>
    <script>
        function activcategory(a){
            $('.categoryproduct').removeClass('active');
            $('.categoryproduct').removeClass('bg-greendark');
            $('#c'+a).addClass('active');
            $('#c'+a).addClass('bg-greendark');
        }
        activcategory(<?=request()->get("id");?>);
    </script>
    <div class="row">
        <?php 
        DB::enableQueryLog();

        $products = DB::table('product')
        ->leftJoin("documentation","documentation.product_id","=","product.product_id")
        ->where(function($q){
            if(isset($_GET["id"])){
                $q->where("category_id",request()->get("id"));
            }
        })
        ->orderBy('product_name','asc')
        ->paginate(50);
       
        
        // ->get();
        // $query = DB::getQueryLog();
        // dd($query);
        // echo $products->toSql();die;
        ?>
        <?php 
        if(!isset($_GET["id"])){?>
            <div class="col-md-12 border border-light border-3 rounded m-3 p-3 text-left">
                <div class="fs-3 fw-bold">Dokumentasi Produk Qithy.my.id</div>
                <div>Silahkan membuka tab yang sesuai dengan produk yang anda cari!</div>
            </div>
        <?php }else{
        foreach ($products as $product){?>
        <div class="col-md-12 p-1" >
            <div class="card p-3" >
                <img src="<?=url('/images/product_picture/'.$product->product_picture);?>" class="card-img-top" alt="{{ $product->product_name }}" style="width:150px; height:auto!important;">
                <div class="card-body mt-4 p-5">
                    <h5 class="card-title fs-1 fw-bold">{{ $product->product_name }}</h5>                   
                    <h5 class="card-title text-default">{{$product->documentation_title}}</h5>
                    <div class="d-grid gap-2">
                    <?=$product->documentation_content;?>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        }?>
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