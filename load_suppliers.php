<?php
include("check.php");


include("connect.php");
$query = "select * from suppliers order by name";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "";
while ( $row = mysqli_fetch_assoc($result) ) {
	$cH .= "<option value=\"".$row["supplier_id"]."\">".$row["name"]."</option>";
	
}
echo $cH;
?>
