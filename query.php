<?php 
/* Import API */
require_once('api.php'); 
?>

<?php
/*
 1- User fills out the form (Dan)
 
 2- Pull out polling location via API and jquery (Margaret & Dan)
 
 3- 
    If one, just fill in field with polling location (Dan)
 	If more than one, promt the user to select which location (Dan)

 4- User sends the form
 
 5- Insert polling location into polling table
 
 6- Get id inserted
 
 7- Insert polling_id, start, end into time_future table
 
 8- Get id inserted
 
 9- Insert all information into profile table
 
*/

//4- Start 
	//code goes here
	//if(isset($_POST['margaret'])&&isset()	
	
	//variables to get
	$phone = "";
	$address = ""; //this one might be a combination of fields
	$polling = "";
	$day = "";
	$start = "";
	$end = "";
	
	//variables to get from insertions
	$polling_id = "";
	$time_future_id = "";
	
	//variable that takes the value 'y' when all data is present, else give NULL
	$complete_registration = "";
//4- End


//5 - Start
	$query_polling = "INSERT INTO `polling` VALUES (NULL, '$polling');";
//5 - End

	$connection = connectDB();// connect to database

//6- Start
	$polling_id = get_inserted_id($connection, $query_polling);
//6- End


//7- Start
	$query_future = "INSERT INTO `time_future` VALUES (NULL, '$polling_id', '$start', '$end');";
//7- End


//8- Start
	$time_future_id = get_inserted_id($connection, $query_future);
//8- End


//9- Start
	$query_profile = "INSERT INTO `profile` VALUES (NULL, '$phone', '$address', '$polling_id', '$time_future_id', '$complete_registration';";
	mysqli_query($connection, $query_profile);
//9- End

	mysqli_close($connection);// close the connection to the database


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>