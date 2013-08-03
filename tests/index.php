<?php

require __DIR__.'/../php/twilio-sender.php';

class mockdb {

	
	public $location;
	public $pollingLoc;

	public function getLocationForUser($phone) {
		return $this->location;
	}

	public function insertAddress($location){
		$this->pollingLoc = $location;
	}
}

$db = new mockdb();
$from = "2153456789";
$lastMsg = Messages::WhatsYourAddress;
$sender = new twilioSender($lastMsg, $from, $db);

?>

<html>
<body>

<div>Test Cases</div>
<div>
	<?php 
		$db->location = null;
		echo $sender->getResponseType("time") == Messages::WhatsYourAddress; 
	?>
</div>

<div>
	<?php 
		$db->location = "300 W 23rd St New York NY";
		$sender->lastMsg = Messages::WhatsYourAddress;
		echo $sender->getResponseType("time") == Messages::GetTimes; 
		echo $mockdb->pollingLoc == "PS 33, 281 9 Avenue, New York, NY, 10001";
	?>
</div>

<div>
	<?php 
		$db->location = "300 W 23rd St New York NY";
		$sender->lastMsg = Messages::GetTimes;
		echo $sender->getResponseType("time") == Messages::GetTimes; 
		echo $mockdb->pollingLoc == "PS 33, 281 9 Avenue, New York, NY, 10001";
	?>
</div>

</body>
</html>