<?php  

include "../config/configurasi.php";

$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_self where no_kpi_self='$_GET[no_kpi_self]'"));

$return_arr = array("kpi" => $result['kpi'],
                    "realisasi" => $result['realisasi']);

// Encoding array in JSON format
echo json_encode($return_arr);

?>