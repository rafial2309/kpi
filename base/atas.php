<?php
session_start();
if (!isset($_SESSION['nik'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}
if (isset($_SESSION['periode'])) {
  $periode = $_SESSION['periode'];
}else{
  $periode = date("Y");
}
include 'config/configurasi.php';
include 'base/head.php'; 
include 'base/m-mobile.php'; 
?>