<?php
include("check.php");


include("connect.php");

if ( intval($_POST["customer_id"]) == 0 ) {

	$query = "insert into customers(name) values(
			'".mysqli_real_escape_string($conn,$_POST["name"])."')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update customers set
				name='".mysqli_real_escape_string($conn,$_POST["name"])."'
				where customer_id=".intval($_POST["customer_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>
