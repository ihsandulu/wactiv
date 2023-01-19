
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
            <h1 class="text-bold">Tambah Layanan</h1>
        </div>
        <div align="right" class="col-md-6 m-0 mb-3"><a href="{{ url('/layanan') }}" class="btn btn-warning fa fa-mail-forward"> Kembali</a></div>
    </div>
   
    <div class="row">
        <div class="col-md-12 p-1" >
            <div class="card p-3" >
                
                <div class="card-body mt-4">
                    <div class="d-grid gap-2">
                        <div id="keterangan">
                            <div>Isi data server anda:</div>                           
                        </div>
                        <div class="row" id="konfirmasi">
                            <h1 class="col-md-12"> Data Server </h1>
                            <form method="post">
                            @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Nama Server (dilarang spasi)" name="tranprod_no">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Keterangan" name="tranprod_note">
                                    </div>
                                    <div class="col">                                        
                                        <input type="hidden" name="product_id" value="<?=Request::get('product_id');?>">
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