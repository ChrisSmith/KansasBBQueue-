<?php
// function connectDB(){
// 	$db_host = "localhost"; 
// 	$db_username = "root";  
// 	$db_pass = "password";  
// 	$db_name = "kansasbbqueue"; 
// 	$connection = mysqli_connect("$db_host","$db_username","$db_pass","$db_name");
// 	if (!$connection) {
// 	    die('Connect Error (' . mysqli_connect_errno() . ') '
// 	            . mysqli_connect_error());
// 	}
// 	else{
// 		//echo 'Success... ' . mysqli_get_host_info($connection) . "\n";
// 	}  
// 	return $connection;   
// }

function get_inserted_id($connection, $query) {
	mysqli_query($connection, $query_polling);
	return mysqli_insert_id($connection);
}

function getStamp($date, $timezone) {
	date_default_timezone_set("America/New_York");
	$date = new DateTime($dateStr, new DateTimeZone($timezone));
	return strtotime($date);
}

function setDate($y, $m, $d, $h, $min, $sec) {
	return $y."-".$m."-".$d." ".$h.":".$min.":".$sec;
}

function getCurrentTimestamp() {
	date_default_timezone_set("America/New_York");
	$date = date('Y-m-d H:i:s');
	$time = strtotime('-4 hours', strtotime($date));
	return $time;
}
?>