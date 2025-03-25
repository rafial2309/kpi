<?php 
include '../config/configurasi.php';
session_start();
if (!isset($_SESSION['no_user'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}

$id = $_GET["id"];

$query = "DELETE from warehouse where no_warehouse='$id'";
$data_query= mysqli_query($conn,$query);

//LOG
session_start();
date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('d F Y H:i:s');
$catatan = $waktu . " : HAPUS DATA WAREHOUSE OLEH - " . $_SESSION['nama_user'];
mysqli_query($conn,"INSERT into log values('','$catatan')");

header("Location: ../index?p=warehouse");
die();

 ?>