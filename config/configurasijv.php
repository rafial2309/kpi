<?php
//error_reporting(0);
//session_start();

// $conn = mysqli_connect('localhost','root','','db_kpi');
$conn = mysqli_connect('103.176.44.250','itjeeves','Welcome@2025#Jeeves','jeevesimtap');
if (!$conn) {
	echo "DB FAILED!";
	exit();
}
/*$server = "BP\SQLEXPRESS";
$conn = mssql_connect('$server','sa','','JV-PO');
if ($conn) 
{
    echo 'Berhasil konek!';
}
else
{
    echo 'Koneksi GAGAL!';
}*/
?>