<?php 
include '../config/configurasi.php';
session_start();
if (!isset($_SESSION['no_user'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}

$kode_warehouse 	= $_POST["kode_warehouse"];
$nama_warehouse 	= $_POST["nama_warehouse"];
$pt_warehouse 		= $_POST["pt_warehouse"];
$no_telp 			= $_POST["no_telp"];

$query = "INSERT into warehouse values(0,'$kode_warehouse','$nama_warehouse','$pt_warehouse','$no_telp')";
$data_query= mysqli_query($conn,$query);

//LOG
session_start();
date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('d F Y H:i:s');
$catatan = $waktu . " : SIMPAN DATA WAREHOUSE '".$nama_warehouse."' BARU OLEH - " . $_SESSION['nama_user'];
mysqli_query($conn,"INSERT into log values(0,'$catatan')");


header("Location: ../index?p=warehouse");
die();

 ?>