<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Monitoring</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="https://www.pngall.com/wp-content/uploads/5/Profile-Transparent.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>profile.php" class="d-block"><?= $dataUserLogin['nama_lengkap']; ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Charts
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>charts/suhu_dan_kelembaban_chart.php" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Suhu dan Kelembaban</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>charts/arus_dan_tegangan_chart.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Arus dan Tegangan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>tables/suhu_dan_kelembaban_table.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Suhu dan Kelembaban</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>tables/arus_dan_tegangan_table.php" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Arus dan Tegangan</p>
              </a>
            </li>
            
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>calendar.php" class="nav-link ">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Calendar
              <span class="badge badge-info right"></span>
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>