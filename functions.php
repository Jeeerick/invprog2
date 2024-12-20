<?php
function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	$str = "";
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}

function formatn($number,$count) {

	$temp = strval($number);
	if ( strlen($temp) >= $count ) {
		return $temp;
	}
	else {
		$zeros = "";
		for ( $i = 0; $i < $count-strlen($temp); $i++ ) 
			$zeros .= "0";
		return $zeros.$temp;
	}
}
?>
