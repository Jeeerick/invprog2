<?php
include("check.php");


include("connect.php");


$query = "delete from customers where customer_id=".$_POST["customer_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));


?>

