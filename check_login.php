<?php


include("connect.php");


$query = "select * from users where username='".mysqli_real_escape_string($conn,$_POST["username"])."' and
			password='".mysqli_real_escape_string($conn,$_POST["password"])."'";
			
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$num_rows = mysqli_num_rows($result);

$cRet = "";
if ( $row = mysqli_fetch_assoc($result) ) {
	session_start();
	$_SESSION["user_id"] = $row["user_id"];
	$cRet = "success";
}

echo $cRet;

?>
