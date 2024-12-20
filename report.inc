<?php

// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);// inches X 72 / 2.54 = value
//$multiplier = 72/2.54;
//$pdf = new TCPDF('P', 'mm', array(8.5*$multiplier-15,5.5*$multiplier-18), true); 

//$pdf = new TCPDF("P", 'mm', "LETTER", true);
error_reporting( E_ALL ^ E_DEPRECATED );


if ( !isset($page_orientation) )
	$page_orientation = "P";

$pdf = new TCPDF($page_orientation, 'mm', array($w,$l), true); 

// set document information
$pdf->SetCreator(PDF_CREATOR);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->SetHeaderData("", "", "", "");

$pdf->setPrintHeader(false); $pdf->setPrintFooter(false);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

//set some language-dependent strings
$pdf->setLanguageArray($l); 


$pdf->SetTitle("");

$pdf->SetAutoPageBreak(false);

date_default_timezone_set('Asia/Singapore');

function Format($cText) {

	global $pdf; 

	$cTemp = htmlentities($cText);
	$cTemp = $pdf->unhtmlentities($cTemp);
	
	return stripslashes($cTemp);
}

?>
