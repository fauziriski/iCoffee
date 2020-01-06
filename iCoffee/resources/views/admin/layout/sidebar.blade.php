<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

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
            <a class="collapse-item" href="{{url('validasi-pembeli')}}">Validasi Pembeli</a>
            <a class="collapse-item" href="{{url('jenis-produk')}}">Jenis Produk</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Laporan :</h6>
            <a class="collapse-item" href="{{url('laporan-penjualan')}}">Laporan Penjualan</a>
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
            <a class="collapse-item" href="{{url('validasi-produk-lelang')}}">Validasi Produk</a>
            <a class="collapse-item" href="{{url('proses-lelang')}}">Proses Lelang</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Laporan :</h6>
            <a class="collapse-item" href="{{url('laporan-lelang')}}">Laporan Lelang</a>
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
            <h6 class="collapse-header">Kelola Investasi :</h6>
            <a class="collapse-item" href="{{url('kelompok-petani')}}">Kelompok Petani</a>
            <a class="collapse-item" href="{{url('produk-investasi')}}">Produk Investasi</a>
            <a class="collapse-item" href="{{url('progres-investasi')}}">Progres Investasi</a>
            <a class="collapse-item" href="{{url('pencairan-investasi')}}">Pencairan Investasi</a>

            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Laporan :</h6>
            <a class="collapse-item" href="{{url('laporan-investasi')}}">Laporan Investasi</a>
          </div>
        </div>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
