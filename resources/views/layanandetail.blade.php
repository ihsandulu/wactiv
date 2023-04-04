
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
        <div class="col-6">
            <form method="post" class="was-validated">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Forward Whatsapp:</label>
                    <input type="tel" class="form-control" id="forward_number" placeholder="Enter Whatsapp" name="forward_number" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <input type="hidden" name="tranprod_id" value="<?=$_GET["id"];?>"/>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-6">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-2">Action</th>
                        <th>Forward Whatsapp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $forward=DB::table("forward")
                    ->where("tranprod_id",$_GET["id"])
                    ->get();
                    foreach ($forward as $forward) {?>
                    <tr>
                        <td>
                            <form method="post">      
                                @csrf                      
                                <button type="submit" name="delete" class="btn btn-danger btn-xs fa fa-close"></button>
                                <input type="hidden" name="forward_id" value="<?=$forward->forward_id;?>"/>
                            </form>
                        </td>
                        <td>
                            <?=$forward->forward_number;?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
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
                        <?php 
                        $tgl1 = strtotime(date("Y-m-d")); 
                        $tgl2 = strtotime($product->tranprod_outdate);                         
                        $jarak = $tgl2 - $tgl1;                        
                        $hari = $jarak / 60 / 60 / 24;
                        if($hari<=7){$peringatan="bahaya";}else{$peringatan="aman";}?>  
                        <div class="row" id="barcode1">
                            <?php 
                            $str=$product->product_name;
                            preg_match_all('/(?<=\b)\w/iu',$str,$matches);
                            $result=mb_strtoupper(implode('',$matches[0]));
                            $src=env('APP_URL_UTAMA').":8000/apiwa.html?server=".$product->tranprod_no."&token=".md5($tgl2)."&desc=".$product->product_name;
                            ?>
                            <iframe class="col-md-12 iframe" frameBorder="0" title="Api Whatsapp" src="<?=$src;?>" ></iframe>
                        </div>
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