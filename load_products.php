<?php
include("check.php");


include("connect.php");
$query = "select * from products order by description";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
while ( $row = mysqli_fetch_assoc($result) ) {
	$cH .= "<option value=\"".$row["product_id"]."\">".$row["description"]."</option>";
	
}
echo $cH;
?>

