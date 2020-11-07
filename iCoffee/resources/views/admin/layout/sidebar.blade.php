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
      @can('isAdminsuper')
      <div class="sidebar-brand-text mx-3">Admin Super</div>
      @endcan
      @can('isAdminkeuangan')
      <div class="sidebar-brand-text mx-3">Admin Keuangan</div>
      @endcan
      @can('isAdminweb')
      <div class="sidebar-brand-text mx-3">Admin Web</div>
      @endcan
      @can('isAdminUser')
      <div class="sidebar-brand-text mx-3">Admin User</div>
      @endcan
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @can('isAdminsuper')

    <!-- Nav Item - Beranda -->
    <li class="nav-item active">
      <a class="nav-link" href="{{url('akses-superadmin/beranda')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
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
      Hak Akses
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-key"></i>
          <span>Kelola Akses</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kelola Akses :</h6>
            <a class="collapse-item" href="{{url('akses-superadmin/data-role')}}">Role</a>
            <a class="collapse-item" href="{{url('akses-superadmin/data-akses')}}">Hak Akses</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Aktivitas
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-history"></i>
          <span>Aktivitas Pengguna</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Aktivitas Pengguna:</h6>
            <a class="collapse-item" href="{{url('akses-superadmin/404')}}">Aktivitas Admin</a>
            <a class="collapse-item" href="{{url('akses-superadmin/404')}}">Aktivitas Pelanggan</a>
            <div class="collapse-divider"></div>
          </div>
        </div>
      </li>
      @endcan


      @can('isAdminkeuangan')

      <!-- Nav Item - Beranda -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('akses-adminkeuangan/beranda')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
         Pencatatan Kas Masuk
       </div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-fa fa-arrow-circle-down"></i>
          <span>Kas Masuk</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('akses-adminkeuangan/dana-masuk-utama')}}">Kas Utama</a>
            <div class="collapse-divider"></div>
            <a class="collapse-item" href="{{url('akses-adminkeuangan/dana-masuk-investasi')}}">Kas Investasi</a>
            <h6 class="collapse-header">Lain-Lain :</h6>
            <a class="collapse-item" href="{{url('akses-adminkeuangan/dana-masuk-lain')}}">Kas Lainnya</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
       Pencatatan Kas Keluar
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-fa fa-arrow-circle-up"></i>
        <span>Kas Keluar</span>
      </a>
      <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Investasi :</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/pencairan-dana')}}">Kas Utama</a>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/pencairan-dana-progres')}}">Kas Investasi</a>
          <h6 class="collapse-header">Lain-Lain :</h6>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/administrasi')}}">Kas Operasional</a>
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
          <h6 class="collapse-header">Kelola Keuangan:</h6>
          <!-- <a class="collapse-item" href="{{url('akses-adminkeuangan/404')}}">Posisi Kas</a> -->
          <a class="collapse-item" href="{{url('akses-adminkeuangan/tranksaksi-kas')}}">Tranksaksi Kas</a>
          <!-- <a class="collapse-item" href="{{url('akses-adminkeuangan/arus-kas')}}">Arus Kas</a> -->
          <a class="collapse-item" href="{{url('akses-adminkeuangan/jurnal')}}">Jurnal Umum</a>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/neraca')}}">Neraca</a>
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
          <a class="collapse-item" href="{{url('akses-adminkeuangan/404')}}">Akun Bank</a>
          <div class="collapse-divider"></div>
          <a class="collapse-item" href="{{url('akses-adminkeuangan/404')}}">Format Akun</a>
          <div class="collapse-divider"></div>
        </div>
      </div>
    </li>
    @endcan


    @can('isAdminuser')

    <!-- Nav Item - Beranda -->
    <li class="nav-item active">
      <a class="nav-link" href="{{url('akses-admin/beranda')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
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
             <a class="collapse-item" href="{{url('akses-admin/validasi-pencairan')}}">Validasi Pencairan</a>
             <a class="collapse-item" href="{{url('akses-admin/validasi-komplain')}}">Validasi Komplain</a>
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
            <a class="collapse-item" href="{{url('akses-admin/validasi-komplain-lelang')}}">Validasi Komplain</a>
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
            <a class="collapse-item" href="{{url('akses-admin/validasi-produk-investasi')}}">Validasi Produk</a>
            <a class="collapse-item" href="{{url('akses-admin/validasi-pencairan-petani')}}">Validasi Progres</a>
            <a class="collapse-item" href="{{url('akses-admin/404')}}">Validasi Bagi Hasil</a>
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


      @can('isAdminweb')

<!-- Nav Item - Beranda -->
<li class="nav-item active">
  <a class="nav-link" href="{{url('akses-adminweb/beranda')}}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Beranda</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Artikel
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-pen"></i>
      <span>Kelola Artikel</span>
    </a>
    <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Artikel :</h6>
        <a class="collapse-item" href="{{url('akses-adminweb/kategori-artikel')}}">Kategori</a>
        <a class="collapse-item" href="{{url('akses-adminweb/artikel-blog')}}">Artikel</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    SEO
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-search-dollar"></i>
      <span>Kelola SEO</span>
    </a>
    <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">kelola SEO :</h6>
        <a class="collapse-item" href="{{url('akses-adminweb/slug-artikel')}}">Slug Artikel</a>
        <a class="collapse-item" href="{{url('akses-adminweb/slug-produk')}}">Slug Produk</a>
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
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-th-large"></i>
      <span>Kelola Template</span>
    </a>
    <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Kelola Template:</h6>
        <a class="collapse-item" href="#">Kotak Pesan</a>
        <a class="collapse-item" href="#">Tentang</a>
        <a class="collapse-item" href="#">Kontak</a>
        <div class="collapse-divider"></div>
      </div>
    </div>
  </li>
  @endcan

      
    </ul>






    <!-- End of Sidebar -->
