<?php


//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		
		$image_file = K_PATH_IMAGES.'ptaae-min.png';
		$this->Image($image_file, 15, 8, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', '', 9);
		// Title
		$htmlz = file_get_contents('text_header.php');
		
		$this->writeHTMLCell(0, 0, '', '', $htmlz, '', 1, 0, true, 'L', true);
		$this->writeHTMLCell(0, 0, '', '', "<br><hr/>", '', 1, 0, true, 'L', true);
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-40);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$htmlza = '
		<hr><br>
		<table border="0" cellpadding="3">
			<tr>
				<td></td>
				<td align="center" border="1" >
				JAKARTA , 29 JANUARY 2021	 
<br><br><br><br><br><br>						    
    PT. ATLANTIK AIRSEA EXPRESS          AS AGENT

				</td>
			</tr>
		</table>';
		$this->writeHTMLCell(0, 0, '', '', $htmlza, '', 1, 0, true, 'L', true);

		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('PT Atlantik');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(4, 31, 4);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(50);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 40);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------

// set font
$pdf->SetFont('freeserif', '', 9);


// add a page
$pdf->AddPage();

$htmlatasz = '
<br>
<h2><u>DELIVERY ORDER</u><br/><b style="font-size:9.5px">SURAT PERINTAH PENYERAHAN</b></h2>

';

$pdf->writeHTMLCell(0, 0, '', '', $htmlatasz, '', 1, 0, true, 'C', true);
include '../config/configurasi.php';
$datado = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from delivery_order where nomor_do='ATL-2102-018'"));
$html = '
<br>
<table cellpadding="6" cellspacing="0" border="1" style="font-size:10px">
	<tr>
		<td rowspan="2" colspan="3"><b>NAME SHIPPER: <br>';
		$name_shipper	=	$datado['name_shipper'];
		$html .= $name_shipper;

		$html .= '</b></td>
		<td colspan="2"><b>MASTER B/L NO.</b> <br>';
		$no_master_blawb	=	$datado['no_master_blawb'];
		$html .= $no_master_blawb;

		$html .= '</td>
		<td><b>CARRIER</b><br>';

		$carrier	=	$datado['carrier'];
		$html .= $carrier;
		$html .= '</td>

	</tr>
	<tr>
		<td colspan="3"><b>MASTER D/O NO.</b> <br>';
		$html .= $no_master_blawb;
		$html .= '</td>
	</tr>
	<tr>
		<td colspan="3"><b>PLEASE DELIVER TO:<br>';
		$nama_consignee	=	$datado['nama_consignee'];
		$almt_consignee	=	$datado['almt_consignee'];
		$html .= $nama_consignee . '<br>' . $almt_consignee;

		$html .= '</b></td>
		<td colspan="3"><b>HOUSE B/L NO. </b><br>';
		$no_host_blawb	=	$datado['no_host_blawb'];
		$html .= $no_host_blawb;
		$html .= '</td>
	</tr>
	<tr>
		<td><b>*** CTR NBR *** </b><br>';
		$no_kontainer	=	$datado['no_kontainer'];
		$html .= $no_kontainer;
		$html .= '</td>
		<td><b>*** SEAL NBR***</b><br>';
		$no_segel	=	$datado['no_segel'];
		$html .= $no_segel;
		$html .= '</td>
		<td><b>***SIZE*** </b><br>';
		$ukuran	=	$datado['ukuran'];
		$html .= $ukuran;
		$html .= '</td>
		<td colspan="3"><b>SERVICE TERM</b><br>';
		$jenis_kontainer	=	$datado['jenis_kontainer'];
		$html .= $jenis_kontainer;
		$html .= '</td>
	</tr>
	<tr>
		<td rowspan="2" colspan="2"><b>VESSEL NAME / VOYAGE NUMBER </b><br>';
		$mother_vessel	=	$datado['mother_vessel'];
		$html .= $mother_vessel;
		$html .= '</td>
		<td><b>PORT OF LOADING / ETD</b><br>';
		$pelabuhan_asal	=	$datado['pelabuhan_asal'];
		$tgl_masuk	=	date("d-m-Y",strtotime($datado['tgl_masuk']));
		$html .= $pelabuhan_asal . "<br>".$tgl_masuk;
		$html .= '</td>
		<td rowspan="2" colspan="3"><b>WAREHOUSE:</b><br>';
		$warehouse	=	$datado['warehouse'];
		$dataware = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from warehouse where kode_warehouse='$warehouse'"));
		$nama_warehouse = $dataware['nama_warehouse'];
		$pt_warehouse 	= $dataware['pt_warehouse'];
		$no_telp 		= $dataware['no_telp'];
		$html .= $nama_warehouse . " -- CODE:" . $warehouse . "<br>" . $pt_warehouse . "<br>" . $no_telp;
		$html .= '</td>
	</tr>
	<tr>
		<td><b>PORT OF DISCHARGE / ETA</b><br>';
		$pelabuhan_akhir	=	$datado['pelabuhan_akhir'];
		$tgl_tiba	=	date("d-m-Y",strtotime($datado['tgl_tiba']));
		$html .= $pelabuhan_akhir. "<br>".$tgl_tiba;
		$html .= '</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align="center"><b>MARKS AND NUMBER</b></td>
		<td align="center"><b>NO. OF PKGS</b></td>
		<td align="center" colspan="2"><b>DESCRIPTION OF PACKAGES  AND GOODS<br>(PARTICULARS FURNISHED BY SHIPPER)</b></td>
		<td align="center"><b>GROSS WEIGHT</b></td>
		<td align="center"><b>MEASUREMENT</b></td>
	</tr>

	<tr>
		<td>';
		$merk_kemasan	=	nl2br($datado['merk_kemasan']);
		$html .= $merk_kemasan;
		$html .= '</td>
		<td>';
		$jumlah_kemasan	=	$datado['jumlah_kemasan'];
		$jenis_kemasan	=	$datado['jenis_kemasan'];
		$html .= $jumlah_kemasan . " " . $jenis_kemasan;
		$html .= '</td>
		<td colspan="2">';
		$uraian_barang	= nl2br(str_replace("** ", "<br>", $datado['uraian_barang']));
		$html .= $uraian_barang;
		$html .= '</td>
		<td>';
		$bruto	=	$datado['bruto'];
		$html .= $bruto . " KGS";
		$html .= '</td>
		<td>';
		$volume	=	$datado['volume'];
		$html .= $volume . " CBM";
		$html .= '</td>
	</tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
