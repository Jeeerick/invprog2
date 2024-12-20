<?php

include_once("functions.php");

include("connect.php");

$query = "select invoice_number from sales order by cast(invoice_number as unsigned) desc";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$num_rows = mysqli_num_rows($result);

$cInv = "0000000001";
if ( $num_rows > 0 ) {
	
	$row = mysqli_fetch_assoc($result);
	$cInv = formatn(intval($row["invoice_number"])+1,10);
	
}

echo $cInv;
?>
