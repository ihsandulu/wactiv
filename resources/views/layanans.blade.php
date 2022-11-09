
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
       <!--  <div align="right" class="col-md-6 m-0"><a href="{{ url('/product') }}" class="btn btn-primary fa fa-plus"> Tambah Layanan</a></div> -->
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link categoryproduct active bg-greendark" onclick="activcategory(this)" aria-current="page" href="<?=url("/layanans");?>">Semua</a>
        </li>
        <?php 
            $categorys = DB::table('category')->get();
        ?>
        @foreach ($categorys as $category)
        <li class="nav-item">
          <a id="c{{ $category->category_id }}" class="nav-link categoryproduct" onclick="activcategory(this)" aria-current="page" href="<?=url("/layanans?id=$category->category_id");?>">{{ $category->category_name }}</a>
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

        $products = DB::table('tranprod')
        ->leftJoin("user","user.id","=","tranprod.user_id")
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where("user_id",auth()->user()->id)
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
        <?php foreach ($products as $product){?>
        <div class="col-md-2 p-1" >
            <div class="card p-3" >
                <img src="<?=url('/images/product_picture/'.$product->product_picture);?>" class="card-img-top" alt="{{ $product->product_name }}">
                <div class="card-body mt-4">
                    <h5 class="card-title text-center">{{ $product->product_name }}</h5>
                    <?php 
                        if($product->tranprod_active==1){
                            $active="Active";
                            $color="success";
                        }else{
                            $active="Deactive";
                            $color="danger";
                        }
                     ?>
                     <h5 class="card-title text-center text-default">{{$product->user_name}}</h5>
                    <h5 class="card-title text-center text-{{$color}}">{{$active}}</h5>
                    <div class="d-grid gap-2">
                        <div align="center"><b>Start Date:</b> 
                            <div class="text-success">{{ date("d M, Y",strtotime($product->tranprod_date)); }}</div>
                        </div>
                        <div align="center"><b>Out of Date :</b>
                            <div class="text-danger">{{ date("d M, Y",strtotime($product->tranprod_outdate)); }}</div>
                        </div>
                        <a href="{{ url("/transaction?default=OK&id=".$product->tranprod_id) }}" class="btn btn-info btn-block">Transaction</a>
                        <a href="{{ url("/perpanjangs?id=".$product->tranprod_id) }}" class="btn btn-primary btn-block">History</a><br/>
                        <form method="post">
                            @csrf
                            <input type="hidden" name="tranprod_id" value="{{ $product->tranprod_id }}"/>
                            <button type="submit" name="submit" class="btn btn-warning btn-block text-danger">Perpanjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
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