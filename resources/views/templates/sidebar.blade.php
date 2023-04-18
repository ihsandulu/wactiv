<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light"><img src="images/tokoqit_logo.png" style="width:80px; height:inherit;"/></div>
    <div class="list-group list-group-flush">
        @auth
            <?php if(auth()->user()->position_id==1){?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-secondary text-white disabled" href="#"> Admin </a>
                <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/category?default=OK') }}"> Category </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/product?default=OK') }}"> Produk </a> -->
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/layanans') }}">Layanan</a>
                <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/transaction?default=OK') }}">Transaksi</a> -->
            <?php }?>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-secondary text-white disabled" href="#"> Layanan Customer </a>        
        
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/mcategory') }}">Kategori Member</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/layanan') }}">Layanan</a>
            <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/transactions') }}">Transaksi</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/layanan?expired=OK') }}"> Tagihan </a> -->
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#">{{ auth()->user()->user_name}}</a>
        @endauth
            
        
        @endauth
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/password') }}">Password</a>
        @else                    
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/berita') }}">Berita</a>
        @endauth
    </div>
</div>
            