<?php 
include '../config/configurasi.php';
session_start();
if (!isset($_SESSION['no_user'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}

$carrier = $_POST["carrier"];

$query = "INSERT into carrier values(0,'$carrier')";
$data_query= mysqli_query($conn,$query);

//LOG
session_start();
date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('d F Y H:i:s');
$catatan = $waktu . " : SIMPAN DATA CARRIER BARU OLEH - " . $_SESSION['nama_user'];
mysqli_query($conn,"INSERT into log values(0,'$catatan')");


header("Location: ../index?p=carrier");
die();

 ?>