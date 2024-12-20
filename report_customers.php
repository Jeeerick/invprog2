<?php
/*
 * PRINTING VARIABLES 
*/
//require_once('tcpdf/config/lang/eng.php');
//require_once('tcpdf/tcpdf.php');

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');




$multiplier = 72/2.54-2.80;
$width = 8.5; // inches
$length = 11;  // inches
$w = round($multiplier*$width);
$l = round($multiplier*$length)-2;

include("report.inc");


include("excel.inc");

include("functions.php");


function Head() {

	global $page;
	global $line_height,$char_width;
	global $y;
	global $pdf;
	global $id;
	global $objPHPExcel;
	global $rw;
	
	// add a page
	$page++;
	$pdf->AddPage();
	$pdf->SetFont("courier", "", 8);
	$pdf->SetXY(1*$char_width,1*$line_height); $pdf->Write($line_height,"Printed : ".date("m/d/y h:i:s a"));
	$pdf->SetFont("courier", "", 10);
	$pdf->SetXY(110*$char_width,1*$line_height); $pdf->writeHTML("Page ".number_format($page,0));
	
	$y = 4;
	$pdf->SetFont("courier", "BU", 11);
	
	$pdf->SetXY(35*$char_width,$y*$line_height);
	$pdf->Cell(100,$line_height,"Customers",0,0,"C",0);
	
	$pdf->SetFont("courier", "B", 9);
	
	
	$y+=2;
	$pdf->SetXY(30*$char_width,$y*$line_height);
	$pdf->Cell(20,$line_height,"ID",1,0,"C",0,"",1);
	$pdf->Cell(20,$line_height,"Name",1,0,"C",0,"",1);
	
	
	$pdf->SetFont("courier", "", 9);
	
	if ( $page == 1 ) {
		
		$rw++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rw, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rw, "Name");
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);

	}
	
	
	
	$y++;
	
}

include("connect.php");

date_default_timezone_set('Asia/Singapore');



$query = "select * from customers order by name";

$result = mysqli_query($conn,$query) or die("Error: " . mysql_error());
$num_rows = mysqli_num_rows($result);
$page = 0;
$max_rows=60;
$y = $max_rows+1;
$pdf->SetFont("courier", "", 10);
$line_height = 4.5;
$char_width = 1.706;
$ctr = 0;
$rr = 0;

$pdf->SetAutoPageBreak(false);

$lFirst = true;


error_reporting(E_ALL);
if ( $num_rows == 0 ) {
	die("No available report.");
}
if ( $num_rows > 0 ) {
	$row = mysqli_fetch_assoc($result);
	$nTotal = 0;
	
	while ( true ) {
		
			
		if ( $y > $max_rows ) {

			Head();
		}
	
		$pdf->SetXY(30*$char_width,$y*$line_height);
		$pdf->Cell(20,$line_height,$row["customer_id"],1,0,"L",0,"",1);
		$pdf->Cell(20,$line_height,$row["name"],1,0,"L",0,"",1);
		
		
		$rw++;
		$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow(0,$rw, $row["customer_id"], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow(0,$rw, $row["name"], PHPExcel_Cell_DataType::TYPE_STRING);
		
		$y++;
		
		
		$ctr++;
		echo "<script>";
		echo "top.$('#report_status').html('".intval(number_format(($ctr/$num_rows)*100,0))."%');";
		echo "</script>";
		flush();
			
		$row = mysqli_fetch_assoc($result);
		if ( !$row )
			break;
		
	}
		
}

echo "<script>";
echo "top.$('#report_status').html('".intval(number_format(($ctr/$num_rows)*100,0))."% - generating PDF now...please wait...');";
echo "</script>";
flush();


mysqli_free_result($result);

// ---------------------------------------------------------

mysqli_close($conn);

//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$cXLS = "products".rand_string(10).".xls";
//$objWriter->save($cXLS);



//die($_SERVER['DOCUMENT_ROOT']);
$cF = "customers".rand_string(10).".pdf";
//$cFile = $_SERVER['DOCUMENT_ROOT']."invprog/".$cF;
$cFile = getcwd()."/".$cF;
$pdf->Output($cFile, "F");
sleep(3);


echo "<script>";
echo "top.report.location='".$cF."';";
echo "top.$('#report_status').addClass('hidden');";

//echo "top.$('#report_footer').removeClass('hidden');";
//echo "top.$('#report_footer').html('<a href=".$cXLS.">Download XLS</a>');";

echo "</script>";
flush();



?>
