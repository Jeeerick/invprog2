<?php
include("check.php");


$cH = "<table class='table table-bordered'>
			<tr>
				<th>No.</th>
				<th>Product</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
			</tr>";

$nTotal = 0;
for ( $i = 0; $i < count($_SESSION["purchase_details"]); $i++ ) {
		
	$nT = round($_SESSION["purchase_details"][$i][2]*$_SESSION["purchase_details"][$i][3],2);
	$cH .= "<tr class='details' >
				<td>".($i+1).".</td>
				<td>".$_SESSION["purchase_details"][$i][1]."</td>
				<td align='center'>".$_SESSION["purchase_details"][$i][2]."</td>
				<td align='right'>".number_format($_SESSION["purchase_details"][$i][3],2)."</td>
				<td align='right'>".number_format($nT,2)."</td>
				<td><button type='button' class='remove_detail' index='".$i."'>X</button></td>
			</tr>";
				
				
	$nTotal += $nT;
}

$cH .= "<tr>
			<td colspan='4' align='right'>Total P</td><td align='right'><strong>".number_format($nTotal,2)."</strong></td>
		</tr>
		</table>
		<a name='purchase_bottom'>";
echo $cH;
?>
