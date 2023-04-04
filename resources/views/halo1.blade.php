
@extends('templates/main')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')    
     <!--  <script>
         let token = "";
         // alert($('meta[name="csrf-token"]').attr('content'));   
            $.ajax({
               url: "https://demowanotif.activgenesis.com/api/token",
               method: "GET",
               data: {'email': 'ihsan.dulu@gmail.com', 'password': '12345678'}
            })
            .done(function(token) {
                $.ajax({
                  url: "https://demowanotif.activgenesis.com:8000/send-message",
                  method: "GET",
                  data: {'email': 'ihsan.dulu@gmail.com', 'token': token, 'id':'ag', 'message':'Test pesan dari server', 'number':'08567148813'}
               });
            });
      </script> -->
      <section class="banner_main">
         <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#myCarousel" data-slide-to="1"></li>
               <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <div class="row">
                           <div class="col-md-7 offset-md-5">
                              <div class="text-bg">
                                 <h1> Active Genesis <br>WA Server</h1>
                                 <span>Kami berupaya menjaga kestabilan server agar pengiriman pesan tidak menghadapi kendala.</span>
                                 <!-- <a class="read_more" href="Javascript:void(0)">Read More</a> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </section>
      
@endsection