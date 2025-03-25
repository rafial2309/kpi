<?php 
include '../config/configurasi.php';
session_start();
if (!isset($_SESSION['no_user'])) {
	 echo "<script>
            alert('You must login first!');
            location.href='auth';
          </script>";
}

$cekdatakosong = mysqli_query($conn,"SELECT no_do from delivery_order where (nomor_do='' AND no_user='$_SESSION[no_user]') AND (carrier='' OR warehouse='')");

if (mysqli_num_rows($cekdatakosong)>0) {
	echo "<script>
            alert('Terdapat data yang belum dipilih!');
            location.href='../index?p=validasi';
          </script>";
    exit();
}


//MULAI SAVE
date_default_timezone_set('Asia/Jakarta');
$tahun = date("y");
$bln = date("m");
$perusahaan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from konfigurasi"));

$querydata = mysqli_query($conn,"SELECT no_do,no_master_blawb from delivery_order where nomor_do='' AND no_user='$_SESSION[no_user]'");
$no_master_blawb = '';
while ($data=mysqli_fetch_assoc($querydata)) {
	$no_master_blawb = $data['no_master_blawb'];
	$dataidlast = mysqli_fetch_assoc(mysqli_query($conn,"SELECT max(nomor_do) as maxid from delivery_order"));
	if ($dataidlast['maxid'] == null || $dataidlast['maxid']=='') {
		$numnya = intval($perusahaan['no_do']);
		$nonew = str_pad($numnya,3,"0",STR_PAD_LEFT);
		$nomor_do = $perusahaan['kode_perusahaan']."-".$tahun."".$bln."-".$nonew;
	}else{
		$last = explode("-", $dataidlast['maxid']);
		$numlast = $last[2];
		$numnew = intval($numlast) + 1;
		$nonew = str_pad($numnew,3,"0",STR_PAD_LEFT);
		$nomor_do = $perusahaan['kode_perusahaan']."-".$tahun."".$bln."-".$nonew;
	}
	mysqli_query($conn,"UPDATE delivery_order SET nomor_do='$nomor_do' WHERE no_do='$data[no_do]'");
}


//LOG
session_start();
date_default_timezone_set('Asia/Jakarta'); 
$waktu = date('d F Y H:i:s');
$catatan = $waktu . " : SIMPAN DATA DO BARU OLEH - " . $_SESSION['nama_user'];
mysqli_query($conn,"INSERT into log values(0,'$catatan')");


header("Location: ../index?p=print-e-do&no_master_blawb=".$no_master_blawb);
die();

 ?>