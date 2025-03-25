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

$no_kpi_mat2    = $_POST["no_kpi_mat2"];
$realisasi   = $_POST['realisasi'];

$kpidata = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_matrix where no_kpi_mat='$no_kpi_mat2'"));

$score       = round(($realisasi/$kpidata['target'])*100, 2);
$score_akhir = round(($score*$kpidata['bobot'])/100, 2);

    mysqli_query($conn,"UPDATE kpi_matrix SET realisasi='$realisasi',score='$score',score_akhir='$score_akhir' where no_kpi_mat='$no_kpi_mat2'");




header("Location: ../index?p=matrix");
die();

 ?>