<?php
include("check.php");

if ( !isset($_SESSION["purchase_details"]) )
	$_SESSION["purchase_details"] = array();
	
$_SESSION["purchase_details"][] = array($_POST["product_id"],$_POST["description"],floatval($_POST["quantity"]),floatval($_POST["price"]));
?>
