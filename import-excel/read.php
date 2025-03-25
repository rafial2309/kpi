<?php
/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */
include"../config/configurasi.php";
session_start();
$no_user = $_SESSION['no_user'];
	header('Content-Type: text/plain');

	if (isset($argv[1]))
	{
		$Filepath = $argv[1];
	}
	elseif (isset($_GET['File']))
	{
		$Filepath = "../upload/".$_GET['File'];
	}
	else
	{
		if (php_sapi_name() == 'cli')
		{
			echo 'Please specify filename as the first argument'.PHP_EOL;
		}
		else
		{
			echo 'Please specify filename as a HTTP GET parameter "File", e.g., "/test.php?File=test.xls"';
		}
		exit;
	}

	// Excel reader from http://code.google.com/p/php-excel-reader/
	require('php-excel-reader/excel_reader2.php');
	require('SpreadsheetReader.php');

	date_default_timezone_set('UTC');

	$StartMem = memory_get_usage();

	$tgl_tibahead = '';
	$no_aju = '';
	try
	{
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$BaseMem = memory_get_usage();

		$Sheets = $Spreadsheet -> Sheets();


		foreach ($Sheets as $Index => $Name)
		{
			if ($Index=='0') {

				$Spreadsheet -> ChangeSheet($Index);

				foreach ($Spreadsheet as $Key => $Row)
				{
					if ($Key!='1') {
						if ($Row)
						{
							// echo $Row[0] ."\n";
							// echo $Row[25] ."\n";
							$no_aju = $Row[0];
							$tgl_tibahead = $Row[25];
						}
						else
						{
							var_dump($Row);
						}
					}
					
					// echo "------\n";
					$cekaju = mysqli_query($conn,"SELECT no_aju FROM delivery_order where no_aju='$no_aju'");
					if (mysqli_num_rows($cekaju) > 0) {
						echo "SUDAH ADA AJU";
						exit();
					}
				}
			}

			

			if ($Index=='2') {

				$Spreadsheet -> ChangeSheet($Index);

				foreach ($Spreadsheet as $Key => $Row)
				{
					if ($Key!='1') {
						if ($Row)
						{

							$namashipper 		= addslashes($Row[17]);
							$no_master_blawb 	= $Row[7];
							$carier 			= '';
							$nama_consignee		= addslashes($Row[13]);
							$almt_consignee		= addslashes($Row[14]);
							$no_host_blawb		= $Row[9];
							$no_kontainer		= '';
							$no_segel			= '';
							$ukuran				= '';
							$jenis_kontainer	= '';
							$mother_vessel		= $Row[11];
							$pelabuhan_asal		= $Row[23];
							$tgl_masuk			= date("Y-m-d",strtotime($Row[8]));
							$pelabuhan_akhir	= $Row[26];
							$tgl_tiba			= date("Y-m-d",strtotime($tgl_tibahead));
							$merk_kemasan		= addslashes($Row[29]);
							$jumlah_kemasan		= $Row[27];
							$jenis_kemasan		= $Row[28];
							$uraian_barang		= '';
							$bruto				= $Row[31];
							$volume				= $Row[32];
							$warehouse			= '';
							$id_detil			= $Row[0];

							//echo $id_detil . " \n";

							mysqli_query($conn,"INSERT into delivery_order values (0,'','$namashipper','$no_master_blawb','$carier','$nama_consignee','$almt_consignee','$no_host_blawb','$no_kontainer','$no_segel','$ukuran','$jenis_kontainer','$mother_vessel','$pelabuhan_asal','$tgl_masuk','$pelabuhan_akhir','$tgl_tiba','$merk_kemasan','$jumlah_kemasan','$jenis_kemasan','$uraian_barang','$bruto','$volume','$warehouse','$id_detil','$no_aju','$no_user')");

							//echo("Error description: " . mysqli_error($conn));
							//echo "\n";
							// echo $Row[17] ."\n";
							// echo $Row[7] ."\n";
							// echo "CARRIER \n";
							// echo $Row[13] ."\n";
							// echo $Row[14] ."\n";
							// echo $Row[9] ."\n";
							// echo "no_kontainer \n";
							// echo "no_segel \n";
							// echo "ukuran \n";
							// echo "jenis_kontainer \n";
							// echo $Row[11] ."\n";
							// echo $Row[23] ."\n";
							// echo $Row[8] ."\n";
							// echo $Row[26] ."\n";
							// echo $Row[29] ."\n";
							// echo $Row[27] ."\n";
							// echo $Row[28] ."\n";
							// echo "URAIAN BARANG \n";
							// echo $Row[31] ."\n";
							// echo $Row[32] ."\n";


						}
						else
						{
							var_dump($Row);
						}
					}
					
					// echo "------\n";
				}
			}

			if ($Index=='3') {

				$Spreadsheet -> ChangeSheet($Index);

				foreach ($Spreadsheet as $Key => $Row)
				{
					if ($Key!='1') {
						if ($Row)
						{


							// echo $Row[1] ."** \n";
							// echo $Row[4] ."\n";
							$id_detil2 = $Row[1];
							$barang = addslashes($Row[4]) . " ** ";

							$databarang = mysqli_fetch_assoc(mysqli_query($conn,"SELECT uraian_barang FROM delivery_order where id_detil='$id_detil2' AND no_aju='$no_aju'"));

							$barang = $databarang['uraian_barang'] . $barang;
							// echo $barang . "\n";

							mysqli_query($conn,"UPDATE delivery_order SET uraian_barang='$barang' where id_detil='$id_detil2' and no_aju='$no_aju'");
							
						}
						else
						{
							var_dump($Row);
						}
					}
					
					//echo "------\n";
				}
			}

			if ($Index=='5') {

				$Spreadsheet -> ChangeSheet($Index);

				foreach ($Spreadsheet as $Key => $Row)
				{
					if ($Key!='1') {
						if ($Row)
						{

							// echo $Row[1] ."\n";
							// echo $Row[3] ."\n";
							// echo $Row[7] ."\n";
							// echo $Row[4] ."\n";
							// echo $Row[6] ."\n";
							$id_detil3 			= $Row[1];
							$no_kontainer		= $Row[3];
							$no_segel			= $Row[7];
							$ukuran				= $Row[4];
							$jenis_kontainer	= $Row[6];

							mysqli_query($conn,"UPDATE delivery_order SET no_kontainer='$no_kontainer',no_segel='$no_segel',ukuran='$ukuran',jenis_kontainer='$jenis_kontainer' where id_detil='$id_detil3' and no_aju='$no_aju'");
						}
						else
						{
							var_dump($Row);
						}
					}
					
					// echo "------\n";
				}
			}
			
		}
		
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
		exit();
	}
?>
SUKSES