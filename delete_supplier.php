<?php
include("check.php");


include("connect.php");


$query = "delete from suppliers where supplier_id=".$_POST["supplier_id"];

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));


?>

