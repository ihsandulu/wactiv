
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

<?php if(isset($_POST["beli"])){
    $user_id = auth()->user()->id;
    $product_id = $_POST["product_id"];
    $tranprod_date=date("Y-m-d");
    $tranprod_outdate=date('Y-m-d', strtotime('+1 month', strtotime($tranprod_date)));
    //penomoran
    $nom = DB::table("tranprod")
        ->where("tranprod_date", date("Y-m-d"))
        ->orderBy("tranprod_id", "DESC")
        ->limit("1")
        ->get();
    if ($nom->count() > 0) {
        $noakhir = $nom->first()->tranprod_no;
        $noakh = explode("-", $noakhir);
        if ($noakh[2] > 999) {
            $noak = 1;
        } else {
            $noak = $noakh[2] + 1;
        }
        $noa = str_pad($noak, 2, "0", STR_PAD_LEFT);
    } else {
        $noa = str_pad(1, 2, "0", STR_PAD_LEFT);
    }
    $nomor = array();
    $nomor[1] = "TRP";
    $nomor[2] = date("Ymd");
    $nomor[3] = $noa;
    $nomoran = implode("-", $nomor);
    $id = DB::table('tranprod')->insertGetId(
        array('user_id' => $user_id, 'product_id' => $product_id, 'tranprod_no' => $nomoran,'tranprod_date'=>$tranprod_date,'tranprod_outdate'=>$tranprod_outdate)
    );
    //print_r(DB::getQueryLog());
    ?>
    <div class="container mt-5">Halo</div>
<?php }else{?>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6" >
                <h1 class="text-bold">Tambah Layanan</h1>
            </div>
            <div align="right" class="col-md-6 m-0 mb-3"><a href="{{ url('/layanan') }}" class="btn btn-warning fa fa-mail-forward"> Kembali</a></div>
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
            <?php $products = DB::table('product')
            ->orderBy('product_name')
            ->paginate(50);?>
            <div class="d-flex flex-row-reverse mt-1 col-md-12">{{ $products->links() }}</div>
                @foreach ($products as $product)
                    <div class="col-md-2 p-1" >
                        <div class="card p-3" >
                            <img src="{{ url('/images/product/'.$product->product_picture) }}" class="card-img-top" alt="{{ $product->product_name }}">
                            <div class="card-body mt-4">
                                <h5 class="card-title text-center">{{ $product->product_name }}</h5>
                                <div class="d-grid gap-2">
                                    Rp. {{ number_format($product->product_sell,0,",",".") }} 
                                    <form method="POST" action="{{ url('/product') }}">
                                        @csrf 
                                        <input type="hidden" name="product_id" value="<?=$product->product_id;?>"/>
                                        <button name="beli" class="btn btn-success btn-block">Beli</button>
                                    </form>
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
<?php }?>

@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection