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

$kpi    = $_POST["kpi"];
$textToStore    = nl2br(htmlentities($kpi, ENT_QUOTES, 'UTF-8'));
$no_kpi_self = $_POST['no_kpi_self'];


$query = "UPDATE kpi_self SET kpi='$textToStore' WHERE no_kpi_self='$no_kpi_self'";
$data_query= mysqli_query($conn,$query);


header("Location: ../index?p=selfdev");
die();

 ?>