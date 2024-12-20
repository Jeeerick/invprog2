<html>
	<?php
	include("check.php");
	$_SESSION["sale_details"] = array();
	?>
	
	<head>
		<?php
		include("head.php");
		?>
		<script src="js/sales.js"></script>
	</head>
	
	
	<body>
		
		<div class="container-fluid small"> <!-- Container DIV for BOOTSTRAP -->
			
			<?php
			include("pulldown_menu.php");
			?>	
			<br><br><br>
			<div class="rows">
				
				<div class="col-sm-10">
					
					<h2>Sales</h2>
					Invoice #:&nbsp;<input type="text" size="10" maxlength="10" disabled="true" id="invoice_number">&nbsp;&nbsp;
					Date:&nbsp;<input type="text" size="10" maxlength="10" disabled="true" id="invoice_date" value="<?php echo date("m/d/Y"); ?>"><br><br>
					Customer:&nbsp;<select disabled="true" id="customer_id"></select>
					<hr>
					<input type="hidden" value="0" id="sale_id">
					
					<div id="details">
					</div>
					
					Product:&nbsp;<select disabled="true" id="product_id"></select>&nbsp;
					Qty:<input id="quantity" disabled="true" type="text" value="0" class="text-right" size="5">&nbsp;
					Price:<input id="price" disabled="true" type="text" value="0" class="text-right" size="10">&nbsp;
					Total:<input id="total" disabled="true" type="text" value="0" class="text-right" size="10">&nbsp;
					<button type="button" id="btn_add_product" disabled="true" class="btn btn-success">Add Product</button>
					
					<hr>
					<button type="button" id="btn_new" class="btn btn-primary">New</button>
					<button type="button" disabled="true" id="btn_cancel" class="btn btn-primary">Cancel</button>
					<button type="button" disabled="true" id="btn_delete" class="btn btn-primary">Delete</button>
					<button type="button" id="btn_search" class="btn btn-primary">Search</button>
					<button type="button" id="btn_print" class="btn btn-primary">Print Current Invoice</button>
					<button type="button" id="btn_close" class="btn btn-primary">Close</button>
					
					<div id="message" class="hidden"></div>
					
				</div>
				
			</div>
			
			<div id="search_window" class="modal fade" role="dialog">
					
				<div class="modal-dialog modal-lg" style="width:70%; height:90%; margin:auto;">

					<!-- Modal content-->
					<div class="modal-content">
						
						<br><br>
						<div id="records" class="col-sm-12"></div>
						
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="report_window" class="modal fade" role="dialog">
					
				<div class="modal-dialog modal-lg" style="max-width:90%; width:90%; margin:auto;">

					<!-- Modal content-->
					<div class="modal-content">
						
						
						<div id="report_status" class="h3 text-center hidden">Loading...</div>
						<iframe name="report" src="" style="height:80%; width:100%; overflow:scroll; " frameborder="0"></iframe>
						
						
						<div class="modal-footer">
							<div id="report_footer" class="text-center hidden"></div>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			
		</div>
	</body>
</html>
	
