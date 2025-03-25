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

if ($nik==$_SESSION['nik']) {
    mysqli_query($conn,"UPDATE kpi_self_header SET status='1',tgl_submit='$waktu' where nik='$nik' AND tahun='$tahun'");
    mysqli_query($conn,"UPDATE kpi_self SET status='1' where nik='$nik' AND tahun='$tahun'");
}



header("Location: ../index?p=selfdev");
die();

 ?>