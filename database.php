<?php 
/* Import API */
require_once('api.php'); 
?>

<?php
class database {
	public function __construct(){
	}
	
	public function getLocationForUser($phone) {
		$connection = connectDB();
		$location = NULL;
		
		$query = "SELECT `address` FROM `profile` WHERE `phone` = '$phone'";

		$result = mysqli_query($connection, $query);
		
		if($result !== FALSE && mysqli_num_rows($result) > 0) {
			//pull address
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);
			$location = $row['address'];
		}
		elseif($result !== FALSE && mysqli_num_rows($result) == 0) {
			//insert address
		}
		else {
			//insert user
			$query = "INSERT INTO `profile` VALUES (NULL, '$phone', NULL, NULL, NULL, NULL);";
		}
		
		return $location;
	}
}
?>