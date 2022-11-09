
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
        <?php if (!isset($_GET['product_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
            $coltitle = "col-md-10";
        } else {
            $coltitle = "col-md-8";
        } ?>
        <div class="<?= $coltitle; ?>">
            <h4 class="card-title"></h4>
        </div>       
        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
            <form method="post" class="col-md-2">
            @csrf
                <h1 class="page-header col-md-12">
                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                    <input type="hidden" name="product_id" />
                </h1>
            </form>
        <?php } ?>
    </div>

    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
        <div class="row">
            <?php if (isset($_POST['edit'])) {
                $namabutton = 'name="change"';
                $judul = "Update product";
            } else {
                $namabutton = 'name="create"';
                $judul = "Add product";
            } ?>
            <div class="col-md-12">
                <h3><?= $judul; ?></h3>
            </div>
            <form class="col-md-12" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="category_id" class="form-label">Category:</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="0" <?=($posts["category_id"]==0)?"selected":"";?>>Pilih Category</option>
                        <?php 
                        $categorys=DB::table("category")
                        ->orderBy("category_name","asc")
                        ->get();
                        foreach($categorys as $category){?>
                         <option value="<?=$category->category_id;?>" <?=($posts["category_id"]==$category->category_id)?"selected":"";?>><?=$category->category_name;?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="product_name" class="form-label">Product:</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Enter Product" name="product_name" value="<?=$posts["product_name"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="product_description" class="form-label">Description:</label>
                    <input type="text" class="form-control" id="product_description" placeholder="Enter Description" name="product_description" value="<?=$posts["product_description"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="product_sell" class="form-label">Nominal:</label>
                    <input type="number" class="form-control" id="product_sell" placeholder="Enter Nominal" name="product_sell" value="<?=$posts["product_sell"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="product_waktu" class="form-label">Jangka Waktu:</label>
                    <div>
                    <input type="number" class="form-control col-md-1" id="product_waktu"  name="product_waktu" value="<?=$posts["product_waktu"];?>"  style="float:left;">
                    <select class="form-control  col-md-3" id="product_masa" name="product_masa"  style="display:inline;">
                        <option value="" <?=($posts["product_masa"]=="")?"selected":"";?>>Pilih Waktu</option> 
                        <option value="days" <?=($posts["product_masa"]=="days")?"selected":"";?>>Days</option>                 
                        <option value="month" <?=($posts["product_masa"]=="month")?"selected":"";?>>Month</option>                 
                        <option value="year" <?=($posts["product_masa"]=="year")?"selected":"";?>>Year</option>                        
                    </select>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="product_picture" class="form-label">Picture:</label>
                    <input type="file" class="form-control" id="product_picture" placeholder="Enter Picture" name="product_picture" value="<?=$posts["product_picture"];?>"><br/>
                    <?php if($posts["product_picture"]!=""){$user_image="images/product_picture/".$posts["product_picture"];}else{$user_image="images/nopicture.png";}?>
                    <img id="product_picture_image" width="100" height="100" src="<?=url($user_image);?>"/>
                    <script>
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                    
                                reader.onload = function (e) {
                                    $('#product_picture_image').attr('src', e.target.result);
                                }
                    
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    
                        $("#product_picture").change(function () {
                            readURL(this);
                        });
                    </script>
                </div>
                <input type="hidden" name="product_id" value="<?= $posts["product_id"]; ?>" />
                <input type="hidden" name="created_at" value="<?= date("Y-m-d"); ?>" />
                <input type="hidden" name="updated_at" value="<?= date("Y-m-d"); ?>" />
                <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="pindah()">Back</button>
                <script>
                    function pindah() {
                        window.location.href = '<?= url("product"); ?>';
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
                            <th>Category</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Nominal</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                 
                        $usr = DB::table("product")
                        ->leftJoin("category","category.category_id","=","product.category_id")
                        ->orderBy("product_id","DESC")
                            ->get();
                        $no = 1;
                        foreach ($usr as $usr) {
                        ?>
                            <tr id="d<?= $usr->product_id; ?>">
                                <?php if (!isset($_GET["report"])) { ?>
                                    <td>
                                        <div style="" class="row">
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-danger btn-block delete" onclick="return confirm('You want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                <input type="hidden" name="product_id" value="<?= $usr->product_id; ?>" />
                                            </form>
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                <input type="hidden" name="product_id" value="<?= $usr->product_id; ?>" />
                                            </form>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $usr->category_name; ?></td>
                                <td><?= $usr->product_name; ?></td>
                                <td><?= $usr->product_description; ?></td>
                                <td><?= $usr->product_sell; ?></td>
                                <td><?= $usr->product_waktu." ".$usr->product_masa; ?></td>
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
    // alert();
    </script>
@endsection