<script src="dist/js/jquery/jquery.min.js"></script>
<script src="dist/js/sweetalert2/sweetalert2.all.min.js"></script>
<?php 
require_once 'connection.php';

// jika sudah pernah login
if (isset($_SESSION['id_user']))
{
    header('Location: index.php');
    exit;
}

// jika tombol login ditekan
if (isset($_POST['btnLogin']))
{
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    // cek username
    $cek_username = mysqli_query($connection, "SELECT * FROM user where username = '$username'");
    // jika username ada
    if ($data_user = mysqli_fetch_assoc($cek_username)) {
        // verifikasi password yang di-hash, jika berhasil login ke index
        if (password_verify($password, $data_user['password'])) {
            $_SESSION['id_user'] = $data_user['id_user'];
            header('Location: index.php');
            exit;
        } else {
            setAlert("Gagal", "Username atau Password salah", "error");
            header('Location: login.php');
            exit;
        }
    } else {
        setAlert("Gagal", "Username atau Password salah", "error");
        header('Location: login.php');
        exit;
    }
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="dist/css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg" alt="">
        </div>
        <div class="text-center mt-4 name">
            Monitoring
        </div>
        <form class="p-3 mt-3" method="post">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" name="btnLogin" class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <!-- <a href="#">Forget password?</a> or <a href="#">Sign up</a> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>