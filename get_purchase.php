<?php
include("check.php");


include("connect.php");


$query = "select * from purchases where purchase_id=".$_POST["purchase_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"invoice_number":"'.$row["invoice_number"].'",
			"invoice_date":"'.date("m/d/Y",strtotime($row["invoice_date"])).'",
			"supplier_id":'.$row["supplier_id"].'}';
	
}

$query = "select purchase_details.*,products.description from purchase_details,products where
			purchase_details.product_id=products.product_id and
			purchase_details.purchase_id=".$_POST["purchase_id"]." order by purchase_details.id";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$_SESSION["purchase_details"] = array();
while ( $row = mysqli_fetch_assoc($result) ) {

	$_SESSION["purchase_details"][] = array($row["product_id"],$row["description"],$row["quantity"],$row["price"]);
	
}

echo $cH;

?>

