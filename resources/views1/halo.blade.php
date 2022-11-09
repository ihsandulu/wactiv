
@extends('templates/main')
@section('container')    
      
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
                                 <h1> Kecepatan <br>Pengiriman Pesan</h1>
                                 <span>Kami berupaya menjaga kestabilan server agar pengiriman pesan tidak menghadapi kendala.</span>
                                 <!-- <a class="read_more" href="Javascript:void(0)">Read More</a> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <div class="row">
                           <div class="col-md-7 offset-md-5">
                              <div class="text-bg">
                                 <h1> Support <br>Multi Bahasa</h1>
                                 <span>Dengan supportnya layanan API Whatsapp kami dalam berbagai bahasa pemrograman, amat membantu developer mewujudkan kretifitas mereka dalam mengolah sintak.</span>
                                 <!-- <a class="read_more" href="Javascript:void(0)">Read More</a> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <div class="row">
                           <div class="col-md-7 offset-md-5">
                              <div class="text-bg">
                                 <h1> Hubungi <br>Kami</h1>
                                 <span>Anda dapat menghubungi kami via whatsapp kapan saja ketika anda membutuhkannya.</span>
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
      <!-- end banner -->
      <!-- about -->
      <div id="about" class="about">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="titlepage">
                     <h2>About <span class="green">Us</span></h2>
                     <p>Kami menyadari tingginya kebutuhan developer akan layanan whatsapp untuk aplikasi mereka. Oleh karena itu kami berupaya untuk memberikan layanan terbaik dalam penyedianan API Whatsapp yang dapat di gunakan sesuai kebutuhan.</p>
                     <a class="read_more" href="https://wa.me/628567148813"> Hubungi Kami</a>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="about_img">
                     <figure><img src="images/ihsan.jpg" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!--  service -->
      <div id="service" class="service">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our <span class="green">Services</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="row">
                     <div class="col-md-4 col-sm-6">
                        <div class="service_box">
                           <i><img src="images/service1.png" alt="#"/></i>
                           <h3>Whatsapp API</h3>
                           <p>Cocok untuk developer yang membutuhkan layanan API Whatsapp.</p>
                        </div>
                     </div>
                     <div class="col-md-4 offset-md-1 col-sm-6">
                        <div class="service_box">
                           <i><img src="images/service2.png" alt="#"/></i>
                           <h3>Aplikasi Kasir Toko</h3>
                           <p>Anda pasti membutuhkannya selain untuk aplikasi kasir, fitur customer remindernya menjaga customermu agar tetap berbelanja.</p>
                        </div>
                     </div>
                     <div class="col-md-4 offset-md-3 col-sm-6 mar_top">
                        <div class="service_box">
                           <i><img src="images/service3.png" alt="#"/></i>
                           <h3>Website Pemesanan Online</h3>
                           <p>Sudah saatnya toko, percetakan, apotik dan semua usahamu harus bisa melayani pesanan online dalam websitemu.</p>
                        </div>
                     </div>
                     <div class="col-md-4 offset-md-1 col-sm-6 mar_top">
                        <div class="service_box">
                           <i><img src="images/service4.png" alt="#"/></i>
                           <h3>Manajemen Produksi</h3>
                           <p>Kenapa PPIC masih bingung menghitung stok setiap barang di masing-masing Divisi. Cukup gunakan aplikasi kami yang bisa diakses dimana saja.</p>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <a class="read_more" href="{{ url('/services') }}"> Lihat Layanan Kami Lainnya</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end service -->
      <!-- gallery -->
      <div id="gallery"  class="gallery">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our <span class="green">Customers</span></h2>
                     <p>Telah banyak perusahaan dan instansi yang memakai jasa kami.</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <!-- <div class="col-md-4 col-sm-6">
                  <div class="gallery_text">
                     <div class="galleryh3">
                        <h3>Interior Design</h3>
                        <p>of passages of Lorem <br>
                           Ipsum available <br>
                           , but the majority <br>
                           have suffer
                        </p>
                     </div>
                  </div>
               </div> -->
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/aketajawe.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/binasantri.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/kkp.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/jayamortar.png" alt="#"/></figure>
                  </div>
               </div>   
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/wahana.gif" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/kingpoin.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/global-mandiri.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/syakhir.png" alt="#"/></figure>
                  </div>
               </div>     
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/martabakairmancur.jpg" alt="#"/></figure>
                  </div>
               </div>    
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/lp2k.jpeg" alt="#"/></figure>
                  </div>
               </div>  
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/kejaksel.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6">
                  <div class="gallery_img">
                     <figure><img src="images/serviceberkah.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end gallery -->
      <!-- design -->
      <div class="design">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-5">
                  <div id="design" class="carousel slide banner_design" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#design" data-slide-to="0" class="active"></li>
                        <li data-target="#design" data-slide-to="1"></li>
                        <li data-target="#design" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="text_de">
                                          <div class="titlepage">
                                             <h2>Peluncuran <span class="green">Produk Baru</span></h2>
                                          </div>
                                          <p>Sekarang setiap ada produk baru. Kamu dapat menawarkannya by sistem, tanpa harus mengirim whatsapp satu-satu.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="text_de">
                                          <div class="titlepage">
                                             <h2>Pengingat <span class="green">Belanja</span></h2>
                                          </div>
                                          <p>Asik kan setiap bulan customermu di ingatkan sistem, untuk ganti oli kendaraan di bengkelmu.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="text_de">
                                          <div class="titlepage">
                                             <h2>Ucapan <span class="green">Selamat</span></h2>
                                          </div>
                                          <p>Customer merasa tersanjung ketika kamu memberi ucapan selamat padanya yang dikirim oleh sistemmu.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#design" role="button" data-slide="prev">
                     <i class="fa fa-angle-left" aria-hidden="true"></i>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#design" role="button" data-slide="next">
                     <i class="fa fa-angle-right" aria-hidden="true"></i>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
               <div class="col-md-7 pad_roght0">
                  <div class="design_img">
                     <figure><img src="images/messages.jpg" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end design -->
      <!-- latest news -->
      <!-- <div  class="latest_news">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Read Our <span class="green">Latest News</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 offset-md-2">
                  <div id="new" class="news_box">
                     <div class="news_img">
                        <figure><img src="images/blog1.jpg" alt="#"/></figure>
                     </div>
                     <div class="news_room">
                        <span>Post By :limelight</span>
                        <ul>
                           <li><a href="Javascript:void(0)">Like <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Comment <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Share <i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                        </ul>
                        <h3>Interior Design</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content  </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 ">
                  <div id="new" class="news_box">
                     <div class="news_img mr_le">
                        <figure><img src="images/blog1.jpg" alt="#"/></figure>
                     </div>
                     <div class="news_room">
                        <span>Post By :limelight</span>
                        <ul>
                           <li><a href="Javascript:void(0)">Like <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Comment <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)">Share <i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                        </ul>
                        <h3>Artictecture</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content  </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <a class="read_more" href="Javascript:void(0)"> Read More</a>
               </div>
            </div>
         </div>
      </div> -->
      <!-- end latest news -->
      <!-- testimonial -->
      <div id="testimonial" class="Testimonial">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-8 pad_left0">
                  <div id="testimon" class="carousel slide banner_testimonial" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#testimon" data-slide-to="0" class="active"></li>
                        <li data-target="#testimon" data-slide-to="1"></li>
                        <li data-target="#testimon" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="container">
                              <div class="carousel-caption relative">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="images/unknown.png" alt="#"/></i>
                                          <span>Bpk. Agus (Pengurus SMK Avicena Tenjo)</span>
                                          <p>Saya mengurus sebuah sekolah swasta, dan seringkali terganggu dengan duplikat penagihan pada orang tua siswa. Dengan bot whatsapp ini, sistem saya dapat mengirim sendiri penagihan tanpa khawatir duplikat dengan tagihan yang telah dibayar.</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="text_humai">
                                          <i><img src="images/unknown.png" alt="#"/></i>
                                          <span>Bpk. Agus (Kepala Sekolah SMPN27 Depok)</span>
                                          <p>Sekarang para orang tua dapat memantau absensi siswa, karena sistem kami sudah dapat mengirim Whatsapp ketika mereka melakukan absensi dengan Kartu Pelajar masing-masing.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#testimon" role="button" data-slide="prev">
                     <i class="fa fa-angle-left" aria-hidden="true"></i>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#testimon" role="button" data-slide="next">
                     <i class="fa fa-angle-right" aria-hidden="true"></i>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 ">
                  <div class="titlepage">
                     <h2>Testimonial</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end design -->
      <!--  contact -->
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Daftar Sekarang</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <form id="request" class="main_form">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Name" type="type" id="name" name="name"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="type" id="email" name="email"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="type" id="phone" name="phone">                          
                        </div>
                        <div class="col-md-12">
                           <select class="contactus" id="paket" name="paket">
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn">Daftar</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive row">
                        <div class="col-md-6">
                            <div class="card p-2 naik" style="text-align:center;">
                                <img class="card-img-top" src="images/tokoqit_logo.png" alt="Card image">
                                <div class="card-body">
                                    <h2 class="card-title">Bulanan</h2>
                                    <h4 class="card-text text-success text-bold">Paling Laris</h4>
                                    <ol class="text-default">
                                        <li>Tanpa batas pesan.</li>
                                        <li>Tanpa batas aplikasi.</li>  
                                    </ol>
                                    <p class="card-text mt-4 mb-4">Rp. 300.000,-</p>
                                    <button type="button" onclick="paket('Bulanan')" class="btn btn-block btn-primary">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-2 naik" style="text-align:center;">
                                <img class="card-img-top" src="images/tokoqit_logo.png" alt="Card image">
                                <div class="card-body">
                                    <h2 class="card-title">Tahunan</h2>
                                    <h4 class="card-text text-danger text-bold">Hemat 2 Bulan</h4>
                                    <ol class="text-default">
                                        <li>Tanpa batas pesan.</li>
                                        <li>Tanpa batas aplikasi.</li>  
                                    </ol>
                                    <p class="card-text mt-4 mb-4">Rp. 3.000.000,-</p>
                                    <button type="button" onclick="paket('Tahunan')" class="btn btn-block btn-primary">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <script>
function paket(a){
    $("#paket").val(a);
    $('#name').focus();
}
        </script>
      
@endsection