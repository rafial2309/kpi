<?php 
//error_reporting(0);
function anti_injection($data){
  $filter=stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filter;
}

date_default_timezone_set('Asia/Jakarta');
//include"../config/configurasi.php";
include"../config/configurasijv.php";


$username=anti_injection($_POST['username']);
$password=md5(anti_injection($_POST['password']));


if (($_POST['username']=='') or ($_POST['password']=='')) {
	echo"<script>window.location=('../auth?error=error&msg=mohon isi form username dan password')</script>";
	exit();
}else {

$login=mysqli_query($conn, "SELECT * FROM karyawan WHERE nik='$username' AND pin_pos='$password' AND status_karyawan!='KELUAR'");

$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

	if (mysqli_num_rows($login)) {

		session_start();
		$_SESSION['nik']=$r['nik'];
		$_SESSION['nama']=$r['nama'];
		$_SESSION['jabatan']=$r['jabatan'];
		$_SESSION['divisi']=$r['divisi'];

		
		echo "<script>window.location=('../index')</script>";
	} else {
	
		echo "<script>window.location=('../auth.php?error=error&msg=nik atau pin yang anda masukkan tidak sesuai')</script>";
	}
}
?>
