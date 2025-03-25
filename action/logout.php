<?php
	include"../config/configurasi.php";

	error_reporting(0);
	session_start();

		date_default_timezone_set('Asia/Jakarta'); 
		$waktu = date('d F Y H:i:s');
		$catatan = $waktu . " : LOGOUT SISTEM OLEH - " . $_SESSION['nama_user'];
		mysqli_query($conn,"INSERT into log values('','$catatan')");

	session_destroy();
	echo "<script type='text/javascript'>window.location='../index.php'</script>";
	
?>
