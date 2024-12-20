<?php
include("check.php");


include("connect.php");
$query = "select * from categories order by description";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
while ( $row = mysqli_fetch_assoc($result) ) {
	$cH .= "<option value=\"".$row["category_id"]."\">".$row["description"]."</option>";
	
}
echo $cH;
?>

