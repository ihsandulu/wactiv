
@extends('templates/main')

@section('header')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce1',  // change this value according to your HTML
            plugins: 'image',
            menu: {
                file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
                edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
                view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
                insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
                format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
                tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
                table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' },
                help: { title: 'Help', items: 'help' }
            },
            toolbar: 'image',
            image_list: [
                {title: 'Whatsapp API', value: 'http://localhost:81/wapi/public/images/tokoqit_logo.png'},
                {title: 'Qithy.com', value: 'https://www.qithy.com/wp-content/uploads/2020/02/cropped-cropped-qithykecil-1-2.png'}
            ]
        });

        
        tinymce.init({
        selector: '.tinymce',
        plugins: 'image code',
        toolbar: 'undo redo | link image | code',
        /* enable title field in the Image dialog*/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
            URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
            images_upload_url: 'postAcceptor.php',
            here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
            Note: In modern browsers input[type="file"] is functional without
            even adding it to the DOM, but that might not be the case in some older
            or quirky browsers like IE, so you might want to add it to the DOM
            just in case, and visually hide it. And do not forget do remove it
            once you do not need it anymore.
            */

            input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                Note: Now we need to register the blob in TinyMCEs image blob
                registry. In the next release this part hopefully won't be
                necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
            };

            input.click();
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

    </script>
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
        <?php if (!isset($_GET['documentation_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
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
                    <input type="hidden" name="documentation_id" />
                </h1>
            </form>
        <?php } ?>
    </div>

    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
        <div class="row">
            <?php if (isset($_POST['edit'])) {
                $namabutton = 'name="change"';
                $judul = "Update Documentation";
            } else {
                $namabutton = 'name="create"';
                $judul = "Add Documentation";
            } ?>
            <div class="col-md-12">
                <h3><?= $judul; ?></h3>
            </div>
            <form class="col-md-12" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="product_id" class="form-label">Product:</label>
                    <select class="form-control" id="product_id" name="product_id">
                        <option value="0" <?=($posts["product_id"]==0)?"selected":"";?>>Pilih Product</option>
                        <?php 
                        $products=DB::table("product")
                        ->orderBy("product_name","asc")
                        ->get();
                        foreach($products as $product){?>
                         <option value="<?=$product->product_id;?>" <?=($posts["product_id"]==$product->product_id)?"selected":"";?>><?=$product->product_name;?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="documentation_title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="documentation_title" placeholder="Enter documentation" name="documentation_title" value="<?=$posts["documentation_title"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="documentation_content" class="form-label">Description:</label>
                    <input type="text" class="form-control tinymce" id="documentation_content" placeholder="Enter Description" name="documentation_content" value="<?=$posts["documentation_content"];?>">
                </div>
               
                <input type="hidden" name="documentation_id" value="<?= $posts["documentation_id"]; ?>" />
                <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="pindah()">Back</button>
                <script>
                    function pindah() {
                        window.location.href = '<?= url("documentation"); ?>';
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
                            <th>Product</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                 
                        $usr = DB::table("documentation")
                        ->leftJoin("product","product.product_id","=","documentation.product_id")
                        ->orderBy("documentation_id","DESC")
                            ->get();
                        $no = 1;
                        foreach ($usr as $usr) {
                        ?>
                            <tr id="d<?= $usr->documentation_id; ?>">
                                <?php if (!isset($_GET["report"])) { ?>
                                    <td>
                                        <div style="" class="row">
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-danger btn-block delete" onclick="return confirm('You want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                <input type="hidden" name="documentation_id" value="<?= $usr->documentation_id; ?>" />
                                            </form>
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                <input type="hidden" name="documentation_id" value="<?= $usr->documentation_id; ?>" />
                                            </form>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $usr->product_name; ?></td>
                                <td><?= $usr->documentation_title; ?></td>
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