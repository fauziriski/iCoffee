<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="\mitra">
      <div class="sidebar-brand-icon">
        <i class="fas fa-coffee"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Mitra Investasi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('mitra')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Heading -->

        <div class="sidebar-heading">
          Produk Investasi
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kelola Produk Investasi</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Kelola Produk Investasi :</h6>
              <a class="collapse-item" href="{{ url('mitra/produk-investasi')}}">Produk Investasi</a>
              <a class="collapse-item" href="{{ url('mitra/pasang-investasi')}}">Pasang Produk</a>
              <a class="collapse-item" href="{{url('mitra/progress-investasi')}}">Progress Investasi</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Laporan :</h6>
              <a class="collapse-item" href="#">Laporan Investasi</a>
            </div>
          </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Heading -->
        <div class="sidebar-heading">
          Data Keuangan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Kelola Keuangan</span>
          </a>
          <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Kelola Keuangan :</h6>
              <a class="collapse-item" href="{{url('mitra/rekening-mitra')}}">Rekening Mitra</a>
              <a class="collapse-item" href="{{url('mitra/pengajuan-dana')}}">Pengajuan Dana</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Laporan :</h6>
              <a class="collapse-item" href="#">Laporan Keuangan</a>
            </div>
          </div>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>






      <!-- End of Sidebar -->
