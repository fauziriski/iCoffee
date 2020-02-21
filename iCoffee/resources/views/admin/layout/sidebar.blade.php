<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>

      <!-- untuk superadmin -->
      @can('isSuperadmin')
      <div class="sidebar-brand-text mx-3">SuperAdmin</div>
      @endcan
      @can('isAdminkeuangan')
      <div class="sidebar-brand-text mx-3">Admin Keuangan</div>
      @endcan
      @can('isAdmin')
      <div class="sidebar-brand-text mx-3">Admin</div>
      @endcan
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @can('isSuperadmin')

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{url('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengguna
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-users"></i>
          <span>Kelola Pengguna</span>
        </a>
        <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Pengguna :</h6>
            <a class="collapse-item" href="{{url('akses-superadmin/data-pelanggan')}}">Data Pelanggan</a>
            <a class="collapse-item" href="{{url('akses-superadmin/data-admin')}}">Data Administrator</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Keuangan
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-coins"></i>
          <span>Kelola Keuangan</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Keuangan :</h6>
            <a class="collapse-item" href="{{url('validasi-pembayaran')}}">Dana Masuk</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Dana Keluar</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Saldo</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengeluaran Dana
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>Kelola Pengeluaran</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Pengeluaran:</h6>
            <a class="collapse-item" href="{{url('akses-adminkeuangan/administrasi')}}">Administrasi</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Pembelian Aset</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Lain-lain</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>
      @endcan


      @can('isAdminkeuangan')

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('admin')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
         Pencatatan Pendapatan
       </div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-fa fa-arrow-circle-down"></i>
          <span>Pendapatan</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Investasi :</h6>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Dana Investasi</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Bagi Hasil</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Jual-Beli :</h6>
            <a class="collapse-item" href="{{url('akses-adminkeuangan/dana-masuk-jualbeli')}}">Dana Masuk</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Keuntungan</a>
            <h6 class="collapse-header">Lelang :</h6>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Dana Masuk</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Keuntungan</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
       Pencatatan Pengeluaran
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-fa fa-arrow-circle-up"></i>
        <span>Pengeluaran</span>
      </a>
      <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Investasi :</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/setor-petani')}}">Setoran Ke Petani</a>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/keluar-bagi-hasil')}}">Pencairan Dana</a>
          <h6 class="collapse-header">Jual-Beli :</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/setor-penjual')}}">Dana Penjual</a>
          <h6 class="collapse-header">Lelang :</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/setor-lelang')}}">Dana Lelang</a>
          <h6 class="collapse-header">Administrasi :</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/administrasi')}}">Biaya Operasional</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Laporan Keuangan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-window-restore"></i>
        <span>Laporan Keuangan</span>
      </a>
      <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola Pengeluaran:</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/arus-kas')}}">Arus Kas</a>
          <a class="collapse-item" href="{{url('jenis-produk')}}">Buku Besar</a>
          <a class="collapse-item" href="{{url('jenis-produk')}}">Jurnal</a>
          <a class="collapse-item" href="{{url('jenis-produk')}}">Laba/Rugi</a>
          <a class="collapse-item" href="{{url('jenis-produk')}}">Neraca Saldo</a>
          <a class="collapse-item" href="{{url('jenis-produk')}}">Posisi Keuangan/Saldo</a>
          <div class="collapse-divider"></div>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Pengaturan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-cog"></i>
        <span>Pengaturan</span>
      </a>
      <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pengaturan:</h6>
          <a class="collapse-item" href="{{url('validasi-pembayaran')}}">Format Arus Kas</a>
          <div class="collapse-divider"></div>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/format-akun')}}">Format Akun</a>
          <div class="collapse-divider"></div>
        </div>
      </div>
    </li>
    @endcan


    @can('isAdmin')

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{url('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Heading -->

      <div class="sidebar-heading">
        Jual-Beli
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-tags"></i>
          <span>Kelola Jual-Beli</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Jual-Beli :</h6>
            <a class="collapse-item" href="{{ url('akses-admin/validasi-pembeli')}}">Validasi Pembayaran</a>
            <a class="collapse-item" href="{{url('akses-admin/jenis-produk')}}">Jenis Produk</a>
            <a class="collapse-item" href="{{url('akses-admin/kategori-produk')}}">Kategori Produk</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Lelang
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-balance-scale"></i>
          <span>Kelola Lelang</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Lelang :</h6>
            <a class="collapse-item" href="{{ url('akses-admin/validasi-pembeli-lelang')}}">Validasi Pembayaran</a>
            <a class="collapse-item" href="{{ url('akses-admin/validasi-top-up')}}">Validasi Top-Up</a>
            <a class="collapse-item" href="{{ url('akses-admin/validasi-produk-lelang')}}">Validasi Produk</a>
            <a class="collapse-item" href="{{url('akses-admin/proses-lelang')}}">Proses Lelang</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Investasi
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Kelola Investasi</span>
        </a>
        <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Validasi Petani :</h6>
            <a class="collapse-item" href="{{url('akses-admin/mitra-koperasi')}}">Mitra Koperasi</a>
            <a class="collapse-item" href="{{url('akses-admin/kelompok-tani')}}">Mitra Kelompok Tani</a>
            <a class="collapse-item" href="{{url('akses-admin/mitra-perorangan')}}">Mitra Perorangan</a>
            <h6 class="collapse-header">Kelola Investasi :</h6>
            <a class="collapse-item" href="{{url('akses-admin/validasi-produk-investasi')}}">Validasi Produk Investasi</a>
            <a class="collapse-item" href="{{url('progres-investasi')}}">Progres Investasi</a>
            <a class="collapse-item" href="{{url('pencairan-investasi')}}">Pencairan Investasi</a>
            <h6 class="collapse-header">Kelola Investor :</h6>
            <a class="collapse-item" href="{{url('akses-admin/validasi-investor')}}">Validasi Investor</a>
            <a class="collapse-item" href="{{url('akses-admin/validasi-pembiayaan')}}">Validasi Pembiayaan</a>
          </div>
        </div>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      @endcan
    </ul>






    <!-- End of Sidebar -->
