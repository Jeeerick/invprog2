<?php
include("check.php");


include("connect.php");


$query = "select * from products order by description";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-bordered'>
			<tr>
				<th>Description</th>
				<th>Code</th>
				<th>Cost</th>
				<th>Beg. Qty.</th>

			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["product_id"]."'>
				<td>".$row["description"]."</td>
				<td>".$row["product_code"]."</td>
				<td>".$row["cost"]."</td>
				<td>".$row["beginning_qty"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

