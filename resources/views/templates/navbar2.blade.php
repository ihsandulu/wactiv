  <!-- header -->
  <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.html" class="p-2">
                                <!-- <img src="images/logo.png" alt="#" style="width:auto; height:30px;" class="align-self-center"/>  -->
                                <span class="align-self-center" style="font-size:50px;">Active Genesis</span> 
                              </a> 
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-10 offset-md-1">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="{{ url('/') }}">Home</a>
                              </li>
                              @auth
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                              </li>
                              <li class="nav-item">
                              @else 
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/register') }}">Register</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/login') }}">Login</a>
                              </li>                   
                              @endauth
                              </li>
                              @auth
                              <?php if(auth()->user()->position_id==1){?>
                                <!-- <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/category?default=OK') }}"> Category </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/product?default=OK') }}"> Produk </a>
                                </li> -->
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/layanans') }}">Layanan</a>
                                </li>
                                <!-- <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/transaction?default=OK') }}">Transaksi</a>
                                </li> -->
                              <?php }else{?>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/layanan') }}">Layanan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#">{{ auth()->user()->user_name}}</a>
                                </li>
                              <?php }?>
                              @else                    
                                 <!-- <a class="nav-link" href="{{ url('/berita') }}">Berita</a> -->
                              @endauth
                              <?php if(Auth::check()&&auth()->user()->position_id==1){?>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/documentation?default=OK') }}">Dokumentasi</a>
                              </li>
                              <?php }else{?>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/documentations') }}">Dokumentasi</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="https://wa.me/628567148813?text=Support%20Active%20Genesis%20WA%20Server">Support</a>
                              </li>
                              <?php }?>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
