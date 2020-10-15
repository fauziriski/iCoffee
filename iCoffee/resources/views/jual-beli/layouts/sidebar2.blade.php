<style>
    li {
        list-style-type: none;
    }
  </style>
  
  <section class="ftco-section" style=" padding: 2em 0;position: relative; margin-bottom: 40px">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row flex-column flex-md-row">
                    <aside class="col-12 col-md-3 p-0 flex-shrink-1 mr-2 rounded mt-2">
                        <nav class="navbar navbar-expand navbar-primary border flex-md-column flex-row align-items-start py-2" style="border-radius: 20px">
                            <div class="collapse navbar-collapse ">
                                <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-around">
                                    <li class="nav-item">
                                        <a class="nav-link pl-0 text-nowrap" data-toggle="collapse" href="#submenu-1">
                                            <i class="fas fa-id-card fa-fw"></i> <span class="font-weight-bold d-none d-md-inline"> Profile &nbsp <i class="fas fa-chevron-down"></i></span>
                                        </a>
                                    
                                        <ul id="submenu-1" class="panel-collapse collapse panel-switch pl-0" role="menu">
                                            <li class="nav-item"><a class="nav-link" href="/profile/edit"><i class="fas fa-edit"></i> Edit Profile</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/profile/alamat"><i class="fas fa-address-card"></i> Alamat</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-0 text-nowrap" data-toggle="collapse" href="#submenu-2">
                                            <i class="fas fa-money-check-alt fa-fw"></i> <span class="font-weight-bold d-none d-md-inline"> Top Up &nbsp <i class="fas fa-chevron-down"></i></span>
                                        </a>
                                        <ul id="submenu-2" class="panel-collapse collapse panel-switch pl-0" role="menu">
                                            <li class="nav-item"><a class="nav-link" href="/profile/top_up/history"><i class="fas fa-history"></i> Riwayat</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/profile/tarik_saldo"><i class="fas fa-wallet"></i> Cairkan Saldo</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/profile/konfirmasi/top_up"><i class="fas fa-handshake"></i> Konfirmasi Top Up</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item has-treeview">
                                        <a class="nav-link pl-0" data-toggle="collapse" href="#submenu-3">
                                            <i class="fas fa-store-alt fa-fw"></i> <span class="font-weight-bold d-none d-md-inline">Jual Beli &nbsp <i class="fas fa-chevron-down"></i></span>
                                        </a>
                                        <ul id="submenu-3" class="panel-collapse collapse panel-switch pl-0" role="menu">
                                            <li class="nav-item"><a class="nav-link" href="/jual-beli/transaksi/penjualan"><i class="fas fa-history"></i> Riwayat Penjualan</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/jual-beli/produk-saya"><i class="fas fa-store-alt"></i> Produk Anda</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/jual-beli/transaksi/pembelian"><i class="fas fa-history"></i> Riwayat Pembelian</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/jual-beli/konfirmasi"><i class="fas fa-handshake"></i> Konfirmasi Pembayaran</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-0" data-toggle="collapse" href="#submenu-4">
                                            <i class="fas fa-stopwatch fa-fw"></i> <span class="font-weight-bold d-none d-md-inline">Lelang &nbsp <i class="fas fa-chevron-down"></i></span>
                                        </a>
                                        <ul id="submenu-4" class="panel-collapse collapse panel-switch pl-0" role="menu">
                                            <li class="nav-item"><a class="nav-link" href="/lelang/transaksi/penjualan"><i class="fas fa-history"></i> Riwayat Penjualan</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/lelang/produk-saya"><i class="fas fa-store-alt"></i> Produk Anda</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/lelang/transaksi/pembelian"><i class="fas fa-history"></i> Riwayat Pembelian</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/jual-beli/konfirmasi/lelang"><i class="fas fa-handshake"></i> Konfirmasi Pembayaran</a></li>
                                        </ul>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link pl-0" href="#"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Codeply</span></a>
                                    </li>--}}
                                </ul>
                            </div>
                        </nav>
                    </aside>