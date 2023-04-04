<!-- Top navigation-->
<nav class="navbar navbar-expand-lg navbar-light border-bottom" style="z-index:100;">
  <div class="container-fluid">
    
      @auth      
      <button class="btn btn-primary" id="sidebarToggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
      @else
      <img src="images/tokoqit_logo.png" style="width:100px; height:inherit;"/>
      @endauth
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
              <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
              @auth
                <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
              @else 
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li> 
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>      
              @endauth
              <?php if(Auth::check()&&auth()->user()->position_id==1){?>
                <li class="nav-item"><a class="nav-link" href="{{ url('/documentation?default=OK') }}">Dokumentasi</a></li>
              <?php }else{?>
                <li class="nav-item"><a class="nav-link" href="{{ url('/documentations') }}">Dokumentasi</a></li>
                <li class="nav-item"><a class="nav-link" href="https://wa.me/628567148813?text=Support%20TokoQit">Support</a></li>
              <?php }?>
              <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#!">Action</a>
                        <a class="dropdown-item" href="#!">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Something else here</a>
                  </div>
              </li> -->
            </ul>
      </div>
  </div>
</nav>