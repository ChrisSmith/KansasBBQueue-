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
$from = "8563576043";
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


</body>
</html>