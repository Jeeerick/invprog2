<?php
include("check.php");


include("connect.php");


$query = "select sales.*,customers.name from sales,customers
		where sales.customer_id=customers.customer_id
		order by sales.invoice_date desc,sales.invoice_number desc";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-bordered'>
			<tr>
				<th>Invoice #</th>
				<th>Date</th>
				<th>Customer</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["sale_id"]."'>
				<td>".$row["invoice_number"]."</td>
				<td>".date("m/d/Y",strtotime($row["invoice_date"]))."</td>
				<td>".$row["name"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

