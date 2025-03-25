<?php 
include '../config/configurasi.php';

session_start();
if (!isset($_SESSION['no_user'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}


$query = "DELETE from delivery_order where nomor_do='' AND no_user='$_SESSION[no_user]'";
$data_query= mysqli_query($conn,$query);

//LOG
session_start();
date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('d F Y H:i:s');
$catatan = $waktu . " : BATALKAN DO OLEH - " . $_SESSION['nama_user'];
mysqli_query($conn,"INSERT into log values('','$catatan')");

header("Location: ../index?p=import");
die();

 ?>