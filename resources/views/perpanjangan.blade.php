
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
    <div class="row mb-3">
        <div class="col-md-6" >
            <h1 class="text-bold">Konfirmasi Pembayaran</h1>
        </div>
        <div align="right" class="col-md-6 m-0 mb-3"><a href="{{ url('/layanan') }}" class="btn btn-warning fa fa-mail-forward"> Kembali</a></div>
    </div>
   
    <div class="row">
        <?php 
        $products = DB::table('tranprod')
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where("tranprod_id",$_GET["id"])
        ->orderBy('product_name')        
        ->get();
        ?>
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
                        <div id="keterangan">
                            <div>Silahkan transfer sejumlah <span style="color:blue!important;">Rp. {{number_format($product->product_sell,0,",",".")}}</span> ke Rekening Berikut:</div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>User</th>
                                    <th>Bank No</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $banks = DB::table('bank')
                                ->orderBy('bank_name')
                                ->get();
                                foreach ($banks as $bank) {?>
                                <tr>
                                    <td><?=$bank->bank_name;?></td>
                                    <td><?=$bank->bank_user;?></td>
                                    <td><?=$bank->bank_no;?></td>
                                </tr>
                                <?php }?>  
                                </tbody>
                            </table>
                        </div>
                        <div class="row" id="konfirmasi">
                            <h1 class="col-md-12"> Konfirmasi Pembayaran </h1>
                            <form method="post">
                            @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Bank Pengirim" name="transaction_bankpengirim">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Atas Nama" name="transaction_an">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Rekening" name="transaction_rek">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Bank Penerima" name="transaction_bankpenerima">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" placeholder="Nominal" name="transaction_pay">
                                    </div>
                                    <div class="col">                                        
                                        <input type="hidden" name="product_name" value="<?=$product->product_name;?>">
                                        <input type="hidden" name="tranprod_id" value="<?=request()->get('id');?>">
                                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                        <button type="submit" name="submit" value="OK" class="btn btn-success">Konfirmasi</button>
                                    </div>                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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