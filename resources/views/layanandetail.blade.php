
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
    </style>
@endsection
@section('container')
{{-- @dd($posts) --}}
<hr/>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-6" >
            <h1 class="text-bold">Detail Layanan</h1>
        </div>
        <div align="right" class="col-md-6 m-0 mb-3"><a href="{{ url('/layanan') }}" class="btn btn-warning fa fa-mail-forward"> Kembali</a></div>
    </div>
   
    <div class="row">
        <?php $products = DB::table('tranprod')
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where("tranprod_id",$_GET["id"])
        ->orderBy('product_name')
        ->paginate(50);?>
        @foreach ($products as $product)
        <div class="col-md-12 p-1" >
            <div class="card p-3" >
                <img src="{{ url("/images/product_picture/".$product->product_picture) }}" class="card-img-top top-right" alt="{{ $product->product_name }}">
                <div class="card-body mt-4">
                    <h1 class="card-title text-center text-bold text-success">{{ $product->product_name }}</h1>
                    <h3 class="card-title text-center text-bold text-primary">{{ $product->tranprod_no }}</h3>
                    <div class="d-grid gap-2">
                        <div align="center">Start of Date : <b>{{ date("d M, Y",strtotime($product->tranprod_date)); }}</b></div>
                        <?php 
                        $tgl1 = strtotime(date("Y-m-d")); 
                        $tgl2 = strtotime($product->tranprod_outdate);                         
                        $jarak = $tgl2 - $tgl1;                        
                        $hari = $jarak / 60 / 60 / 24;
                        if($hari<=7){$peringatan="bahaya";}else{$peringatan="aman";}?>
                        <div align="center" class="<?=$peringatan;?>">Out of Date : <b>{{ date("d M, Y",strtotime($product->tranprod_outdate)); }}</b></div>
                        <?php if($peringatan=="bahaya"){?>
                        <a href="{{ url("/perpanjangan?id=".$product->tranprod_id) }}" class="btn btn-success btn-block">Perpanjang Lisensi {{ $product->tranprod_no }}</a>
                        <?php }else{?>
                        <div class="row" id="barcode1">
                            <?php 
                            $str=$product->product_name;
                            preg_match_all('/(?<=\b)\w/iu',$str,$matches);
                            $result=mb_strtoupper(implode('',$matches[0]));
                            $src=env('APP_URL_UTAMA').":8000/apiwa.html?server=".$product->tranprod_no."&token=".md5($tgl2)."&desc=".$product->product_name;
                            ?>
                            <iframe class="col-md-12 iframe" frameBorder="0" title="Api Whatsapp" src="<?=$src;?>" ></iframe>
                        </div>
                        <?php }?>
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