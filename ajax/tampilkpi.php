<?php  

include "../config/configurasi.php";

$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_matrix where no_kpi_mat='$_GET[no_kpi_mat]'"));

$return_arr = array("kpi" => $result['kpi'],
                    "bobot" => $result['bobot'],
                    "realisasi" => $result['realisasi'],
                    "jenis_target" => $result['jenis_target'],
                    "target" => $result['target']);

// Encoding array in JSON format
echo json_encode($return_arr);

?>