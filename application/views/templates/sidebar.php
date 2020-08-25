    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Al-Azhar</div>
      </a>

      
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading text-light">
        Admin <br>Al-Azhar
      </div>
      
      <li class="nav-item" id="sidebarPeserta">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropone" aria-expanded="true" aria-controls="dropone">
          <i class="fas fa-users"></i>
          <span>Peserta</span>
        </a>
        <div id="dropone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Peserta</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>peserta">List Peserta</a>
            <a class="collapse-item text-light bg-success" href="#addPeserta" data-toggle="modal">Tambah Peserta</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item" id="sidebarKelas">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#droptwo" aria-expanded="true" aria-controls="droptwo">
          <i class="fas fa-building"></i>
          <span>Kelas</span>
        </a>
        <div id="droptwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Kelas</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>kelas">List Kelas</a>
            <a class="collapse-item text-light bg-success" href="#addKelas" data-toggle="modal">Tambah Kelas</a>
          </div>
        </div>
      </li>

      <!-- <li class="nav-item" id="sidebarKelas">
        <a class="nav-link" href="<?= base_url()?>kelas">
          <i class="fas fa-building"></i>
          <span>Kelas</span>
        </a>
      </li> -->

      <li class="nav-item" id="">
        <a class="nav-link" href="<?= base_url()?>login/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->