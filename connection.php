<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'monitoring');

$connection = mysqli_connect(HOST, USER, PASS, DB) or die('Koneksi Gagal');

include_once 'include/alert.php'; 

function setAlert($title='', $text='', $type='', $buttons='') {
	$_SESSION["alert"]["title"]		= $title;
	$_SESSION["alert"]["text"] 		= $text;
	$_SESSION["alert"]["type"] 		= $type;
	$_SESSION["alert"]["buttons"]	= $buttons; 
}

if (isset($_SESSION['alert'])) {
	$title 		= $_SESSION["alert"]["title"];
	$text 		= $_SESSION["alert"]["text"];
	$type 		= $_SESSION["alert"]["type"];
	$buttons	= $_SESSION["alert"]["buttons"];

	echo"
		<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
		<script>
			let title 		= $('#msg').data('title');
			let type 		= $('#msg').data('type');
			let text 		= $('#msg').data('text');
			let buttons		= $('#msg').data('buttons');

			if(text != '' && type != '' && title != '') {
				Swal.fire({
					title: title,
					text: text,
					icon: type,
				});
			}
		</script>
	";
	unset($_SESSION["alert"]);
}

function checkLogin()
{
	global $connection;
	// jika sudah pernah login
	if (!isset($_SESSION['id_user']))
	{
	    header('Location: login.php');
	    exit;
	}
}

if (isset($_SESSION['id_user'])) {
	function dataUserLogin()
	{
		global $connection;

		$id_user = $_SESSION['id_user'];
	    return mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM user WHERE id_user = '$id_user'"));
	}
}

function ubahUser($data)
{
	global $connection;
	$id_user = htmlspecialchars($data['id_user']);
	$username = htmlspecialchars($data['username']);
	$nama_lengkap = htmlspecialchars($data['nama_lengkap']);
	$query = mysqli_query($connection, "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_user = '$id_user'");
  	return mysqli_affected_rows($connection);
}

function gantiPassword($data) {
	global $connection;
	$dataUserLogin = dataUserLogin();
	$id_user = dataUserLogin()['id_user'];
	$password_lama = htmlspecialchars($data['password_lama']);
	if (!password_verify($password_lama, $dataUserLogin['password'])) {
		setAlert("Gagal", "Password Lama tidak sesuai", "error");
		header("Location: ganti_password.php");
		exit;
	}

	$verifikasi_password_baru = htmlspecialchars($data['verifikasi_password_baru']);
	$password_baru = htmlspecialchars($data['password_baru']);
	
	if ($password_baru != $verifikasi_password_baru) {
		setAlert("Gagal", "Password Baru tidak sesuai dengan Verifikasi Password Baru", "error");
		header("Location: ganti_password.php");
		exit;
	}

	$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
	$query = mysqli_query($connection, "UPDATE user SET password = '$password_hash' WHERE id_user = '$id_user'");
  	return mysqli_affected_rows($connection);
}