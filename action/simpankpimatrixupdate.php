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

$kpi            = $_POST["kpi"];
$textToStore    = nl2br(htmlentities($kpi, ENT_QUOTES, 'UTF-8'));
$bobot          = $_POST["bobot"];
$target         = $_POST["target"];
$jenis_target   = $_POST["jenis_target"];

$no_kpi_mat = $_POST['no_kpi_mat'];


$query = "UPDATE kpi_matrix SET kpi='$textToStore', bobot='$bobot', target='$target', jenis_target='$jenis_target' WHERE no_kpi_mat='$no_kpi_mat'";
$data_query= mysqli_query($conn,$query);


header("Location: ../index?p=matrix");
die();

 ?>