<?php
include("check.php");

array_splice($_SESSION["sale_details"],intval($_POST["index"]),1);

?>
