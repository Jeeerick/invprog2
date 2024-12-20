<?php
include("check.php");


include("connect.php");


$query = "select purchases.*,suppliers.name from purchases,suppliers
		where purchases.supplier_id=suppliers.supplier_id
		order by purchases.invoice_date desc,purchases.invoice_number desc";

$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$cH = "<table class='table table-bordered'>
			<tr>
				<th>Invoice #</th>
				<th>Date</th>
				<th>Supplier</th>
			</tr>
";

while ( $row = mysqli_fetch_assoc($result) ) {

	$cH .= "<tr style='cursor:pointer;' class='current_record' record_id='".$row["purchase_id"]."'>
				<td>".$row["invoice_number"]."</td>
				<td>".date("m/d/Y",strtotime($row["invoice_date"]))."</td>
				<td>".$row["name"]."</td>
			</tr>";
	
}

$cH .= "</table>";

echo $cH;

?>

