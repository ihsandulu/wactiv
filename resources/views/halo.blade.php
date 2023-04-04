
@extends('templates/main')
@section('container')    
      
      <section class="banner_main" style="z-index:-1;">
         <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
               <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
               <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
               <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img src="<?=url('/');?>/images/banner1.jpg" class="d-block w-100 " style="opacity:0.7;">
                  <div class="carousel-caption d-none d-md-block" style="top:30% !important;">
                     <div class="row ">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>
         </div>
         
      </section>
      <!-- end banner -->
      
      
     
      <script>
      function paket(a){
         $("#paket").val(a);
         $('#name').focus();
      }
      </script>
      
@endsection