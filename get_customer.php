<?php
include("check.php");


include("connect.php");


$query = "select * from customers where customer_id=".$_POST["customer_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"name":"'.$row["name"].'",
			"customer_id":'.$row["customer_id"].'}';
	
}


echo $cH;

?>

