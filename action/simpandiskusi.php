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

$diskusi    = $_POST["diskusi"];
$textToStore = nl2br(htmlentities($diskusi, ENT_QUOTES, 'UTF-8'));

$nikfrom    = $_SESSION['nik'];
$nama       = $_SESSION['nama'];
$nikto      = $_POST['nik_to'];

$query = "INSERT into kpi_diskusi values(0,'$nikfrom','$nama','$nikto','$textToStore','$tahun','$waktu')";
$data_query= mysqli_query($conn,$query);

if ($nikfrom=='231116') {
    header("Location: ../index?p=matrixreview&nik=".$nikto);
}else{
    header("Location: ../index?p=matrix");
}

die();

 ?>