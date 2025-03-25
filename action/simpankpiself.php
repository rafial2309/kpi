<?php 
include '../config/configurasi.php';
session_start();
if (!isset($_SESSION['nik'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}

date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('Y-m-d H:i:s');
$tahun = date('Y');


$kpi    = $_POST["kpi"];
$textToStore    = nl2br(htmlentities($kpi, ENT_QUOTES, 'UTF-8'));
$nik    = $_SESSION['nik'];
$nama   = $_SESSION['nama'];


$query = "INSERT into kpi_self values(0,'$nik','$nama','$textToStore','','$waktu','$tahun',0)";
$data_query= mysqli_query($conn,$query);


header("Location: ../index?p=selfdev");
die();

 ?>