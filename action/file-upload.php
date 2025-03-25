<?php
// $target_dir = "../upload/";
// $target_file = $target_dir . basename($_FILES["file"]["name"]);

// if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.'2023'.$_FILES['file']['name'])) {
//    $status = 1;
//    echo $_FILES['file']['name'];
// }

include '../config/configurasi.php';

$tahun               = $_POST['tahun'];
$nik                 = $_POST['nik'];
$no_kpi_mat_dat      = $_POST['no_kpi_mat_dat'];

if (!file_exists('.../upload/' . $tahun)) {
      mkdir('../upload/' . $tahun, 0777, true);
}

$uploadPath = "../upload/".$tahun."/"; 

// File info 
$file_name =  $nik . "-". $_FILES['file']['name']; //getting file name
$imageUploadPath = $uploadPath .$file_name; 
$fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 

// Allow certain file formats 
$allowTypes = array('jpg','png','jpeg','gif'); 
if(in_array($fileType, $allowTypes)){ 
   // Image temp source 
   $imageTemp = $_FILES["file"]["tmp_name"]; 
    
   move_uploaded_file($_FILES["file"]["tmp_name"], $imageUploadPath);

   mysqli_query($conn,"UPDATE kpi_matrix SET bukti='$file_name' where nik='$nik' AND no_kpi_mat='$no_kpi_mat_dat'");
   
}else{ 
   $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
} 