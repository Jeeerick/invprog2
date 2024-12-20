<?php
include("check.php");


include("connect.php");

if ( intval($_POST["product_id"]) == 0 ) {

	$query = "insert into products(product_code,description,category_id,price,cost,beginning_qty) values(
			'".mysqli_real_escape_string($conn,$_POST["product_code"])."',
			'".mysqli_real_escape_string($conn,$_POST["description"])."',
			".intval($_POST["category_id"]).",
			".floatval($_POST["price"]).",
			".floatval($_POST["cost"]).",
			".intval($_POST["beginning_qty"]).")";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}
else {
	
	$query = "update products set
				product_code='".mysqli_real_escape_string($conn,$_POST["product_code"])."',
				description='".mysqli_real_escape_string($conn,$_POST["description"])."',
				category_id=".intval($_POST["category_id"]).",
				price=".floatval($_POST["price"])."
				cost=".floatval($_POST["cost"])."
				beginning_qty=".intval($_POST["beginning_qty"])."
				where product_id=".intval($_POST["product_id"]);
				
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
}

echo "success";
?>
