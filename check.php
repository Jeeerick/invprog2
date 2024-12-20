<?php
session_start();
if ( isset($_SESSION["user_id"]) ) {
	if ( $_SESSION["user_id"] == 0 ) { 
		die("Access denied.");
	}
}
else {
	die("Access denied.");
}
?>
