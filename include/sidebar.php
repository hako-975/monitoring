<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../index.php" class="brand-link">
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
        <a href="../profile.php" class="d-block"><?= $dataUserLogin['nama_lengkap']; ?></a>
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
          <a href="../index.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/index.php') ? 'active': ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/charts/suhu_dan_kelembaban_chart.php') ? 'menu-open': ''; ?> <?= ($_SERVER['REQUEST_URI'] == '/charts/arus_dan_tegangan_chart.php') ? 'menu-open': ''; ?>">
          <a href="#" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/charts/suhu_dan_kelembaban_chart.php') ? 'active': ''; ?> <?= ($_SERVER['REQUEST_URI'] == '/charts/arus_dan_tegangan_chart.php') ? 'active': ''; ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Charts
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../charts/suhu_dan_kelembaban_chart.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/charts/suhu_dan_kelembaban_chart.php') ? 'active': ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Suhu dan Kelembaban</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../charts/arus_dan_tegangan_chart.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/charts/arus_dan_tegangan_chart.php') ? 'active': ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Arus dan Tegangan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item <?= ($_SERVER['REQUEST_URI'] == '/tables/suhu_dan_kelembaban_table.php') ? 'menu-open': ''; ?> <?= ($_SERVER['REQUEST_URI'] == '/tables/arus_dan_tegangan_table.php') ? 'menu-open': ''; ?>">
          <a href="#" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tables/suhu_dan_kelembaban_table.php') ? 'active': ''; ?> <?= ($_SERVER['REQUEST_URI'] == '/tables/arus_dan_tegangan_table.php') ? 'active': ''; ?>">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../tables/suhu_dan_kelembaban_table.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tables/suhu_dan_kelembaban_table.php') ? 'active': ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Suhu dan Kelembaban</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../tables/arus_dan_tegangan_table.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/tables/arus_dan_tegangan_table.php') ? 'active': ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Arus dan Tegangan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="../servo.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/servo.php') ? 'active': ''; ?>">
            <i class="nav-icon fas fa-times"></i>
            <p>
              Dual Axis Solar Tracker
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