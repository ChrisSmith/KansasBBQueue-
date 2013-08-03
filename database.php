<?php 
/* Import API */
require_once('api.php'); 
?>

<?php
class Database {
	public function __construct(){
	}
	
	public function getLocationForUser($phone) {
		$connection = connectDB();
		$location = NULL;
		
		$query = "SELECT `phone` FROM `profile` WHERE `phone` = '$phone'";
		$result = mysqli_query($connection, $query);
		
		if($result !== FALSE && mysqli_num_rows($result) > 0) {
			echo "1";
		
			$query = "SELECT `polling`.`polling` FROM `polling`,`profile` WHERE `polling`.`polling_id` = `profile`.`polling_id` AND `profile`.`phone` = '$phone'";
	
			$result = mysqli_query($connection, $query);
			
			if($result !== FALSE && mysqli_num_rows($result) > 0) {
				//pull address
				echo "2";
				$row = mysqli_fetch_array($result, MYSQLI_BOTH);
				$location = $row['polling'];
			}
		}
		else {
			$query = "INSERT INTO `profile` (`phone`) VALUES ('$phone');";
			echo $query;
			mysqli_query($connection, $query);
		}
		
		mysqli_close($connection);
		return $location;
	}
	
	public function checkIn($phone, $numberOfPeople) {
		$connection = connectDB();
		$timestamp = getCurrentTimestamp();
		$query = "SELECT `polling_id` FROM `profile` WHERE `phone` = '$phone'";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
		$polling_id = $row['polling_id'];
		
		$query = "INSERT INTO `time_present` (`polling_id`, `time`, `people_count`) VALUES ('$polling_id', FROM_UNIXTIME($timestamp), 10);";
		$result = mysqli_query($connection, $query);
		
		mysqli_close($connection);
		
		return 0;
	}
	
	public function reportBooth($phone, $numberOfBooth) {
		$connection = connectDB();
		//$timestamp = getCurrentTimestamp();
		$query = "UPDATE `time_present` INNER JOIN `profile` ON `time_present`.`polling_id` = `profile`.`polling_id` SET  `time_present`.`booth_count` =  '$numberOfBooth' WHERE  `profile`.`phone` = '$phone';";
		mysqli_query($connection, $query);
		mysqli_close($connection);
		
		return 0;
	}
	
	public function insertPollingAddress($phone, $address) {
		$connection = connectDB();
		
		$query = "UPDATE `profile` SET  `address` =  '$address' WHERE  `phone` = '$phone';";
		mysqli_query($connection, $query);
		
		mysqli_close($connection);
		
		return 0;
	}
}
?>