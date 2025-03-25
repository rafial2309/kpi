<?php 
include '../config/configurasi.php';

session_start();
if (!isset($_SESSION['nik'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}

$id = $_GET["id"];

$query = "DELETE from kpi_self where no_kpi_self='$id'";
$data_query= mysqli_query($conn,$query);


header("Location: ../index?p=selfdev");
die();

 ?>