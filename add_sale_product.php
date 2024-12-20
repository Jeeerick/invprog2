<?php
include("check.php");

if ( !isset($_SESSION["sale_details"]) )
	$_SESSION["sale_details"] = array();
	
$_SESSION["sale_details"][] = array($_POST["product_id"],$_POST["description"],floatval($_POST["quantity"]),floatval($_POST["price"]));
?>
