<?php 
require_once 'connection.php';

checkLogin();

$dataUserLogin = dataUserLogin();

if (isset($_POST['btnGantiPassword'])) {
  if (gantiPassword($_POST) > 0) {
    setAlert("Berhasil", "Password berhasil diganti", "success");
    header("Location: profile.php");
    exit;
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once 'include/head.php'; ?>
  <title>Ganti Password - <?= $dataUserLogin['username']; ?></title>
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
            <h1 class="m-0">Ganti Password</h1>
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
            <div class="card p-3">
              <form method="post">
                <input type="hidden" name="id_user" value="<?= $dataUserLogin['id_user']; ?>">
                <div class="form-group">
                  <label for="password_lama">Password Lama</label>
                  <input type="password" class="form-control" name="password_lama" id="password_lama" required>
                </div>
                <div class="form-group">
                  <label for="password_baru">Password Baru</label>
                  <input type="password" class="form-control" name="password_baru" id="password_baru" required>
                </div>
                <div class="form-group">
                  <label for="verifikasi_password_baru">Verifikasi Password Baru</label>
                  <input type="password" class="form-control" name="verifikasi_password_baru" id="verifikasi_password_baru" required>
                </div>
                <button type="submit" name="btnGantiPassword" class="btn btn-primary">Submit</button>
              </form>
            </div>
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
