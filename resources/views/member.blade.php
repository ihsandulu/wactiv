
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
        <?php if (!isset($_GET['member_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
            $coltitle = "col-6";
        } else {
            $coltitle = "col-10";
        } ?>
        <div class="<?= $coltitle; ?>">
            <h4 class="card-title"></h4>
        </div>       
        <form method="get" action="layanan" class="col-2 mb-2">
            @csrf
            <div class="d-grid gap-2">
                <button class="btn btn-secondary btn-lg" value="OK" style="">Layanan</button>
            </div>
        </form>       
        <form method="get" action="layanandetail" class="col-2 mb-2">
            @csrf
            <div class="d-grid gap-2">
                <button class="btn btn-secondary btn-lg" value="OK" style="">Server</button>
                <input type="hidden" name="id" value="<?=$_GET["layananid"];?>" />
                <input type="hidden" name="layananid" value="<?=$_GET["layananid"];?>" />
                <input type="hidden" name="layananname" value="<?=$_GET["layananname"];?>" />
            </div>
        </form>     
        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
            <form method="post" class="col-2 mb-2">
                @csrf
                <div class="d-grid gap-2">
                    <button name="new" class="btn btn-info btn-lg" value="OK" style="">New</button>
                    <input type="hidden" name="member_id" />
                </div>
            </form>
        <?php } ?>
    </div>

    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
        <div class="row">
            <?php if (isset($_POST['edit'])) {
                $namabutton = 'name="change"';
                $judul = "Update Kategori Member";
            } else {
                $namabutton = 'name="create"';
                $judul = "Add Kategori Member";
            } ?>
            <div class="col-md-12">
                <h3><?= $judul; ?></h3>
            </div>
            <form class="col-md-12" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="mcategory_id" class="form-label">Kategori Member:</label>
                    <select class="form-control" id="mcategory_id" name="mcategory_id">
                        <option value="" <?=$posts["mcategory_id"]==""?"selected":"";?>>Pilih Kategori</option>
                        <?php $mcategory=DB::table("mcategory")
                        ->where("tranprod_id",$_GET["layananid"])
                        ->get();
                        foreach($mcategory as $mcategory){?>
                        <option value="<?=$mcategory->mcategory_id;?>" <?=$posts["mcategory_id"]==$mcategory->mcategory_id?"selected":"";?>><?=$mcategory->mcategory_name;?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="member_name" class="form-label">Member:</label>
                    <input type="text" class="form-control" id="member_name" placeholder="Enter Member" name="member_name" value="<?=$posts["member_name"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="member_phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="member_phone" placeholder="Enter Member" name="member_phone" value="<?=$posts["member_phone"];?>">
                </div>
                <input type="hidden" name="member_id" value="<?= $posts["member_id"]; ?>" />
                <input type="hidden" name="tranprod_id" value="<?= $_GET["layananid"]; ?>" />
                <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="pindah()">Back</button>
                <script>
                    function pindah() {
                        window.location.href = '<?= $url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
                    }
                </script>
            </form>
        </div>
    <?php } else { ?>
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
                                <th class="col-md-2">Action</th>
                            <?php } ?>
                            <th class="col-md-1">No.</th>
                            <th>Server</th>
                            <th>Kategori</th>
                            <th>Member</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                 
                        $usr = DB::table("member")
                        ->leftJoin("tranprod","tranprod.tranprod_id","member.tranprod_id")
                        ->leftJoin("mcategory","mcategory.mcategory_id","member.mcategory_id")
                        ->orderBy("member_id","DESC")
                            ->get();
                        $no = 1;
                        foreach ($usr as $usr) {
                        ?>
                            <tr id="d<?= $usr->member_id; ?>">
                                <?php if (!isset($_GET["report"])) { ?>
                                    <td>
                                        <div style="" class="row">
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-danger btn-block delete" onclick="return confirm('You want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                <input type="hidden" name="member_id" value="<?= $usr->member_id; ?>" />
                                            </form>
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                <input type="hidden" name="member_id" value="<?= $usr->member_id; ?>" />
                                            </form>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $usr->tranprod_no; ?></td>
                                <td><?= $usr->mcategory_name; ?></td>
                                <td><?= $usr->member_name; ?></td>
                                <td><?= $usr->member_phone; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?> 
</div>

@endsection
@section('footer')
    <script>
    $(".card-title").html("Member <?=ucfirst($_GET["layananname"]);?>");
    // alert();
    </script>
@endsection