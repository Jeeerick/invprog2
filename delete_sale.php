<?php
include("check.php");


include("connect.php");


$query = "delete from sales where sale_id=".$_POST["sale_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$query = "delete from sale_details where sale_id=".$_POST["sale_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));



?>

