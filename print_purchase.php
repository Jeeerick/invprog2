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
	global $cInvoice_Number, $cInvoice_Date, $cSupplier;
	
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
	$pdf->Cell(100,$line_height,"Purchases Invoice",0,0,"C",0);
	
	$pdf->SetFont("courier", "B", 9);
	
	$y+=2;
	$pdf->SetXY(20*$char_width,$y*$line_height);
	$pdf->SetFont("courier", "", 9);
	$pdf->Cell(30,$line_height,"Invoice #:",0,0,"R",0,"",1);
	$pdf->SetFont("courier", "B", 9);
	$pdf->Cell(30,$line_height,$cInvoice_Number,0,0,"L",0,"",1);
	$pdf->SetFont("courier", "", 9);
	
	$y+=2;
	$pdf->SetXY(20*$char_width,$y*$line_height);
	$pdf->Cell(30,$line_height,"Date:",0,0,"R",0,"",1);
	$pdf->SetFont("courier", "B", 9);
	$pdf->Cell(30,$line_height,$cInvoice_Date,0,0,"L",0,"",1);
	$pdf->SetFont("courier", "", 9);
	
	$y+=2;
	$pdf->SetXY(20*$char_width,$y*$line_height);
	$pdf->Cell(30,$line_height,"Supplier:",0,0,"R",0,"",1);
	$pdf->SetFont("courier", "B", 9);
	$pdf->Cell(100,$line_height,$cSupplier,0,0,"L",0,"",1);
	$pdf->SetFont("courier", "", 9);
	
	
	
	$y+=2;
	$pdf->SetXY(20*$char_width,$y*$line_height);
	$pdf->Cell(60,$line_height,"Description",1,0,"C",0,"",1);
	$pdf->Cell(25,$line_height,"Qty",1,0,"C",0,"",1);
	$pdf->Cell(25,$line_height,"Price",1,0,"C",0,"",1);
	$pdf->Cell(25,$line_height,"Total",1,0,"C",0,"",1);
	
	$pdf->SetFont("courier", "", 9);
	
	if ( $page == 1 ) {
		
		$rw++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rw, "Code");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rw, "Description");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rw, "Price");
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		
	}
	
	
	
	$y++;
	
}

include("connect.php");

date_default_timezone_set('Asia/Singapore');

$query = "select purchases.*,suppliers.name from purchases,suppliers where
			purchases.supplier_id=suppliers.supplier_id and
			purchases.purchase_id=".$_GET["purchase_id"];
$result = mysqli_query($conn,$query) or die("Error: " . mysqli_error($conn));
if ( $row = mysqli_fetch_assoc($result) ) {
	$cInvoice_Number = $row["invoice_number"];
	$cInvoice_Date = date("m/d/Y",strtotime($row["invoice_date"]));
	$csupplier = $row["name"];
	
}


$query = "select purchase_details.*,products.description from purchase_details,products 
		where
		purchase_details.product_id=products.product_id and
		purchase_details.purchase_id=".$_GET["purchase_id"]."
		order by description,price";

$result = mysqli_query($conn,$query) or die("Error: " . mysqli_error($conn));
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
	
		$pdf->SetXY(20*$char_width,$y*$line_height);
		$pdf->Cell(60,$line_height,$row["description"],1,0,"L",0,"",1);
		$pdf->Cell(25,$line_height,number_format($row["quantity"],0),1,0,"R",0,"",1);
		$pdf->Cell(25,$line_height,number_format($row["price"],2),1,0,"R",0,"",1);
		$pdf->Cell(25,$line_height,number_format($row["price"]*$row["quantity"],2),1,0,"R",0,"",1);
		
		$nTotal += round($row["price"]*$row["quantity"],2);
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
	$pdf->SetFont("courier", "B", 9);
	$pdf->SetXY(20*$char_width,$y*$line_height);
	$pdf->Cell(60+25+25,$line_height,"Total P",0,0,"R",0,"",1);
	$pdf->Cell(25,$line_height,number_format($nTotal,2),1,0,"R",0,"",1);
	$pdf->SetFont("courier", "", 9);
		
}

echo "<script>";
echo "top.$('#report_status').html('".intval(number_format(($ctr/$num_rows)*100,0))."% - generating PDF now...please wait...');";
echo "</script>";
flush();


mysqli_free_result($result);

// ---------------------------------------------------------

mysqli_close($conn);




$cF = "purchase".rand_string(10).".pdf";
$cFile = getcwd()."/".$cF;
//$cFile = $_SERVER['DOCUMENT_ROOT']."invprog/".$cF;
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
