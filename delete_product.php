<?php
include("check.php");


include("connect.php");


$query = "delete from products where product_id=".$_POST["product_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));


?>

