<html>
	<?php
	include("check.php");
	?>
	
	<head>
		<?php
		include("head.php");
		?>
		<script src="js/customer.js"></script>
	</head>
	
	
	<body>
		
		<div class="container-fluid"> <!-- Container DIV for BOOTSTRAP -->
			
			<?php
			include("pulldown_menu.php");
			?>	
			<br><br><br>
			<div class="rows">
				
				<div class="col-sm-6">
					
					<h2>Customers</h2>
					Customer Name:&nbsp;<input type="text" size="10" maxlength="10" disabled="true" id="name"><br><br>
					
					<input type="hidden" value="0" id="customer_id">
					
					<button type="button" id="btn_new" class="btn btn-primary">New</button>
					<button type="button" disabled="true" id="btn_cancel" class="btn btn-primary">Cancel</button>
					<button type="button" disabled="true" id="btn_delete" class="btn btn-primary">Delete</button>
					<button type="button" id="btn_search" class="btn btn-primary">Search</button>
					<button type="button" id="btn_print" class="btn btn-primary">Print</button>
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
	
