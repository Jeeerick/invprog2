<?php
include("check.php");


include("connect.php");


$query = "select * from customers order by name";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-bordered'>
			<tr>
				<th>Name</th>

			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["customer_id"]."'>
				<td>".$row["name"]."</td>

			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

