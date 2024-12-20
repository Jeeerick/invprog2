<html>
	
	<head>
		<?php
		session_start();
		$_SESSION["user_id"] = 0;
		include("head.php");
		?>
		<script src="js/login.js"></script>
	</head>
	
	
	<body>
		
		<div class="container"> <!-- Container DIV for BOOTSTRAP -->
			<form onsubmit="return false;">
				<br>
				<div class="col-sm-4" id="login_window">
				
					<h1>Inventory System</h1>
					
					<label for="username">Username</label>
					<input type="text" size="10" maxlength="10" id="username" class="form-control text-left text-primary" value="" placeholder="Enter username">
					
					<label for="password">Password</label>
					<input type="password" size="10" maxlength="10" id="password" class="form-control text-left text-primary" value="" placeholder="Enter password">
					
					<br><br>
					
					<button id="btn_login" type="button" class="btn btn-primary">Log In</button>
					<div id="message" class="hidden">
					</div>
				</div>
			</form>
			
			
			
			
		</div>
	</body>
</html>
	
