<?php
include("check.php");


include("connect.php");

if ( intval($_POST["sale_id"]) == 0 ) {

	$query = "insert into sales(invoice_number,invoice_date,customer_id) values(
			'".mysqli_real_escape_string($conn,$_POST["invoice_number"])."',
			'".date("Y/m/d",strtotime($_POST["invoice_date"]))."',
			".intval($_POST["customer_id"]).")";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$sale_id = mysqli_insert_id($conn);
		
		for ( $i = 0; $i < count($_SESSION["sale_details"]); $i++ ) {
			$query = "insert into sale_details(sale_id,product_id,quantity,price) values(
						".$sale_id.",
						".$_SESSION["sale_details"][$i][0].",
						".$_SESSION["sale_details"][$i][2].",
						".$_SESSION["sale_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["sale_details"] = array();
	
}
else {
	
	$query = "update sales set
				invoice_number='".mysqli_real_escape_string($conn,$_POST["invoice_number"])."',
				invoice_date='".date("Y/m/d",strtotime($_POST["invoice_date"]))."',
				customer_id=".intval($_POST["customer_id"])."
				where sale_id=".intval($_POST["sale_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$sale_id = intval($_POST["sale_id"]);
		
		$query = "delete from sale_details where sale_id=".$sale_id;
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		
		for ( $i = 0; $i < count($_SESSION["sale_details"]); $i++ ) {
			$query = "insert into sale_details(sale_id,product_id,quantity,price) values(
						".$sale_id.",
						".$_SESSION["sale_details"][$i][0].",
						".$_SESSION["sale_details"][$i][2].",
						".$_SESSION["sale_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["sale_details"] = array();
	
}

echo "success";
?>
