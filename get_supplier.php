<?php
include("check.php");


include("connect.php");


$query = "select * from suppliers where supplier_id=".$_POST["supplier_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	
	$cH = '{"name":"'.$row["name"].'",
			"supplier_id":'.$row["supplier_id"].'}';
	
}


echo $cH;

?>

