<?php
include("check.php");


include("connect.php");

if ( intval($_POST["supplier_id"]) == 0 ) {

	$query = "insert into suppliers(name) values(
			'".mysqli_real_escape_string($conn,$_POST["name"])."')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update suppliers set
				name='".mysqli_real_escape_string($conn,$_POST["name"])."'
				where supplier_id=".intval($_POST["supplier_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>
