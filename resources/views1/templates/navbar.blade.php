<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ url('/images/tokoqit_tokoqit_logo.png') }}" alt="" width="50" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item nav-item-top">
          <a class="nav-link">
            <div class="nav-title nav-title-top">Tanggal</div>
            <div class="nav-content">{{ date("d M Y") }}</div>
          </a>
        </li>
        <li class="nav-item nav-item-top">
          <a class="nav-link" target="_self" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item nav-item-top">
          <a class="nav-link" target="_self" href="https://wa.me/628567148813?text=Support%20TokoQit">Support</a>
        </li>
        <li class="nav-item nav-item-top">
          @auth
            <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
          @else                    
            <a class="nav-link" href="{{ url('/login') }}">Login</a>
          @endauth
        </li>
        @auth
        <li class="nav-item nav-item-top">
          <a class="nav-link">
            <div class="nav-title nav-title-top">User</div>
            <div class="nav-content">{{ auth()->user()->user_name}}</div>
          </a>
        </li>
        <li class="nav-item nav-item-top">
          <a class="nav-link" target="_self" href="{{ url('/layanan') }}">Layanan</a>
        </li>
        <li class="nav-item nav-item-top">
          <a class="nav-link" aria-current="page" href="{{ url('/tagihan') }}">
            <div class="nav-title nav-title-top">Tagihan</div>
            <div class="nav-content">3 Tagihan</div>
          </a>
        </li>
        <li class="nav-item nav-item-top">
          <a class="nav-link" target="_self" href="https://wa.me/628567148813?text=Support%20TokoQit">Support</a>
        </li>
        @endauth
        
      </ul>
      @auth
      <form class="d-flex" action="{{ url("/search") }}">
        <input type="hidden" name="item" value="product"/>
        <input name="cari" class="form-control me-2" type="search" placeholder="Cari Server WA" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      @endauth
    </div>
  </div>
</nav> -->

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
                              <a href="index.html"><img src="images/tokoqit_logo.png" alt="#" style="width:auto; height:100px;"/></a>
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
                              <li class="nav-item">
                              @auth
                                 <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                              @else                    
                                 <a class="nav-link" href="{{ url('/login') }}">Login</a>
                              @endauth
                              </li>
                              @auth
                              <?php if(auth()->user()->position_id==1){?>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/categorys') }}"> Category </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/products') }}"> Produk </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/layanans') }}">Layanan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/transactions') }}">Transaksi</a>
                                </li>
                              <?php }else{?>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/layanan') }}">Layanan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/transaction') }}">Transaksi</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ url('/tagihan') }}"> Tagihan </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#">{{ auth()->user()->user_name}}</a>
                                </li>
                              <?php }?>
                              @else                    
                                 <a class="nav-link" href="{{ url('/berita') }}">Berita</a>
                              @endauth
                              <?php if(Auth::check()&&auth()->user()->position_id==1){?>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/documentations') }}">Dokumentasi</a>
                              </li>
                              <?php }else{?>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ url('/documentation') }}">Dokumentasi</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="https://wa.me/628567148813?text=Support%20TokoQit">Support</a>
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
