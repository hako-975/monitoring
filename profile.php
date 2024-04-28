<?php 

require_once 'connection.php';

checkLogin();

$dataUserLogin = dataUserLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Profile - <?= $dataUserLogin['username']; ?></title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include_once 'include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once 'include/sidebar.php'; ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Username:</strong> <?= $dataUserLogin['username']; ?></li>
                <li class="list-group-item"><strong>Nama Lengkap:</strong> <?= $dataUserLogin['nama_lengkap']; ?></li>
                <li class="list-group-item"><a href="ubah_user.php" class="btn btn-primary">Ubah</a> <a href="ganti_password.php" class="btn btn-danger">Ganti Password</a></li>
              </ul>
            </div>
            <h5></h5>
            <h5></h5>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  <?php include_once 'include/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include_once 'include/script.php'; ?>
</body>
</html>
