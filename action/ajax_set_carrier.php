<?php 
include '../config/configurasi.php';



$data = $_GET["data"];
$no_do = $_GET["no_do"];

$query = "UPDATE delivery_order SET carrier='$data' WHERE no_do='$no_do'";
$data_query= mysqli_query($conn,$query);


 ?>