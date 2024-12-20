<?php
include("check.php");


include("connect.php");

if ( intval($_POST["purchase_id"]) == 0 ) {

	$query = "insert into purchases(invoice_number,invoice_date,supplier_id) values(
			'".mysqli_real_escape_string($conn,$_POST["invoice_number"])."',
			'".date("Y/m/d",strtotime($_POST["invoice_date"]))."',
			".intval($_POST["supplier_id"]).")";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$purchase_id = mysqli_insert_id($conn);
		
		for ( $i = 0; $i < count($_SESSION["purchase_details"]); $i++ ) {
			$query = "insert into purchase_details(purchase_id,product_id,quantity,price) values(
						".$purchase_id.",
						".$_SESSION["purchase_details"][$i][0].",
						".$_SESSION["purchase_details"][$i][2].",
						".$_SESSION["purchase_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["purchase_details"] = array();
	
}
else {
	
	$query = "update purchases set
				invoice_number='".mysqli_real_escape_string($conn,$_POST["invoice_number"])."',
				invoice_date='".date("Y/m/d",strtotime($_POST["invoice_date"]))."',
				supplier_id=".intval($_POST["supplier_id"])."
				where purchase_id=".intval($_POST["purchase_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	if ( $result ) {
		$purchase_id = intval($_POST["purchase_id"]);
		
		$query = "delete from purchase_details where purchase_id=".$purchase_id;
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		
		for ( $i = 0; $i < count($_SESSION["purchase_details"]); $i++ ) {
			$query = "insert into purchase_details(purchase_id,product_id,quantity,price) values(
						".$purchase_id.",
						".$_SESSION["purchase_details"][$i][0].",
						".$_SESSION["purchase_details"][$i][2].",
						".$_SESSION["purchase_details"][$i][3].")";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		}
	}
	sleep(2);
	$_SESSION["purchase_details"] = array();
	
}

echo "success";
?>
