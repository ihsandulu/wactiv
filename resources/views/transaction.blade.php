
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
        .red {
        background-color: orange;
        color: white !important;
    }

    .white {
        background-color: none;
        color: black;
    }
    </style>
@endsection
@section('container')
{{-- @dd($posts) --}}


<div class="container mt-5 mainbody">
    <?php
    $now = date("Y-m-d");
    if (isset($_GET['from'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];
    } else {
        $from = date("Y-m-d", strtotime("-1 months", strtotime($now)));
        $to = $now;
    }
    if (isset($_GET['branchid'])) {
        $branchid = $_GET['branchid'];
    } else {
        $branchid = 0;
    }
    ?>
    <div class="row">
        <?php if (!isset($_GET['transaction_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
            $coltitle = "col-md-10";
        } else {
            $coltitle = "col-md-8";
        } ?>
        <div class="<?= $coltitle; ?>">
            <h4 class="card-title"></h4>
        </div>       
        <!-- <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
            <form method="post" class="col-md-2">
            @csrf
                <h1 class="page-header col-md-12">
                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                    <input type="hidden" name="transaction_id" />
                </h1>
            </form>
        <?php } ?> -->
    </div>

        <?php if ($posts["message"] != "") { ?>
            <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?= $posts["message"]; ?></strong>
                </div>
            </div>
            </div>
        <?php } ?>
       <!--  <div class="well">
            <form class="form-inline" action="">
                <label for="from" class="mr-sm-2">From:</label>
                <input type="date" class="form-control mb-2 mr-sm-2" id="from" name="from" value="<?= $from; ?>">
                <label for="to" class="mr-sm-2">To:</label>
                <input type="date" class="form-control mb-2 mr-sm-2" id="to" name="to" value="<?= $to; ?>">  
                <button type="submit" class="btn btn-primary ml-2 mb-2">Search</button>
            </form>
        </div> -->
        
        <div class="row mb-5">
            <div class="col-md-12">
                <table id="example" class="table table-hover table-stripped table-bordered" >
                    <thead class="">
                        <tr class="text-center">
                            <?php if (!isset($_GET["report"])) { ?>
                                <th class="col-md-1">Action</th>
                            <?php } ?>
                            <th class="col-md-1">No.</th>
                            <th>Date</th>
                            <th>Trans No.</th>
                            <th>Product</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Bank Pengirim</th>
                            <th>Bank Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                 
                        $usr = DB::table("transaction")
                        ->leftJoin("user","user.id","=","transaction.user_id")
                        ->leftJoin("tranprod","tranprod.tranprod_id","=","transaction.tranprod_id")
                        ->leftJoin("product","product.product_id","=","tranprod.product_id")
                        ->where(function($q){
                            if(isset($_GET["id"])){
                                $q->where("transaction.tranprod_id",request()->id);
                            }
                        })
                        ->orderBy("transaction_id","DESC")
                        ->get();
                        $no = 1;
                        foreach ($usr as $usr) {
                            switch ($usr->transaction_status) {
                                case '0':
                                    $status="sukses";
                                break;
                                case '1':
                                    $status="batal";
                                break;
                                default:
                                    $status="pending";
                                break;
                            }
                        ?>
                            <tr id="d<?= $usr->transaction_id; ?>">
                                <?php if (!isset($_GET["report"])) { ?>
                                    <td>
                                        <div style="" class="row">
                                            <form method="post" class="btn-action col-md-12" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-danger btn-block delete" onclick="return confirm('You want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"> Delete</span> </button>
                                                <input type="hidden" name="transaction_id" value="<?= $usr->transaction_id; ?>" />
                                            </form>
                                            <form method="post" class="btn-action col-md-12" style="">
                                                @csrf
                                                <input type="hidden" name="tranprod_id" value="{{ $usr->tranprod_id }}"/>
                                                <button type="submit" name="aktifkan" class="btn btn-warning btn-block text-danger"><span class="fa fa-flag" style="color:white;"> Perpanjang</span> </button>
                                            </form>
                                            <!-- <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                <input type="hidden" name="transaction_id" value="<?= $usr->transaction_id; ?>" />
                                            </form> -->
                                        </div>
                                    </td>
                                <?php } ?>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $usr->transaction_date; ?></td>
                                <td><?= $usr->transaction_no; ?><br/><?= $usr->user_name; ?></td>
                                <td><?= $usr->tranprod_no; ?><br/><?= $usr->product_name; ?></td>
                                <td><?= number_format($usr->transaction_pay,0,",","."); ?></td>
                                <td><?= $status; ?></td>
                                <td><?= $usr->transaction_bankpengirim; ?><br/><?= $usr->transaction_an; ?><br/><?= $usr->transaction_rek; ?></td>
                                <td><?= $usr->transaction_bankpenerima; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    
</div>

@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection