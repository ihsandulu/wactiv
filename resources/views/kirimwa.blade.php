
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
    <div class="row">       
    <script>
    <?php 		
    $url = "https://qithy.my.id:8000/send-message";
    // $url = "http://localhost:8000/send-message";
    if($number=="owner"){
        $number=request()->session()->get('number');
        $server='server';
    }else{
        $number=$number;
        $server=$server;
    }
    ?>
    function kirimpesan(message,number,server){
        setTimeout(() => {
            $.get("<?=$url;?>",{message:message,number:number,id:server})
            .done(function(data){	
                
            });
        }, 1000);  
        setTimeout(() => {
            window.location.href = '<?=url("pesan?title=".$title."&pesan=".$pesan);?>';
        }, 2000);       
    }
    let message = '{{$message}}';
    let number = '{{$number}}';
    let server = '{{$server}}';
    kirimpesan(message,number,server);
</script>
    </div>  
</div>
@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection