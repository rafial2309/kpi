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


$nik    = $_GET["nik"];
$nama   = $_SESSION['nama'];

if ($_SESSION['nik']=='231116') {
    mysqli_query($conn,"UPDATE kpi_matrix_header SET status='2',tgl_approve='$waktu' where nik='$nik' AND tahun='$tahun' ");
    mysqli_query($conn,"UPDATE kpi_matrix SET status='2' where nik='$nik' AND tahun='$tahun'");
}



header("Location: ../index?p=matrixreview&nik=".$nik);
die();

 ?>