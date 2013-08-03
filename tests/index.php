<?php

require __DIR__.'/../php/twilio-sender.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

class mockdb {

	public $location;
	public $pollingLoc;
	public $phone;
	public $numPeople;

	public function reset(){
		$this->location = null;
		$this->pollingLoc = null;
		$this->phone = null;
		$this->numPeople = null;
	}

	public function getLocationForUser($phone) {
		return $this->location;
	}

	public function insertAddress($location){
		$this->pollingLoc = $location;
	}

	public function checkIn($phone, $num){
		$this->phone = $phone;
		$this->numPeople = $num;
	}
}

$db = new mockdb();
$from = "2153456789";
$lastMsg = Messages::WhatsYourAddress;
$sender = new twilioSender($lastMsg, $from, $db);

?>

<html>
<head>
<style type="text/css">
.bold {
	font-weight: bold;
}
</style>
</head>
<body>


<div>Test Cases</div>
<div>
	<?php 
		$db->reset();
	?>
	<div class="bold"><?php echo $sender->getResponseType("time") ?> </div> <div><?php echo Messages::WhatsYourAddress; ?> </div>

</div>

<div>
	<?php 
		$db->reset();
		$db->location = "PS 33, 281 9 Avenue, New York, NY, 10001";
		$sender->lastMsg = Messages::WhatsYourAddress;
	?>
	<div class="bold"><?php echo $sender->getResponseType("time") ?> </div> <div><?php echo Messages::GetTimes; ?> </div>
	
</div>

<div>
	<?php 
		$db->reset();
		$sender->lastMsg = Messages::WhatsYourAddress;
	?>
	<div class="bold"><?php echo $sender->getResponseType("300 W 23rd St New York NY") ?> </div> <div><?php echo Messages::Help; ?> </div>
	<div class="bold"><?php echo $db->pollingLoc ?> </div> <div><?php echo "PS 33, 281 9 Avenue, New York, NY, 10001" ?> </div>	
</div>

<div class="bold">Report Times</div>
<div>
	<?php 
		$db->reset();
		$db->location = "PS 33, 281 9 Avenue, New York, NY, 10001";
		$sender->lastMsg = Messages::Help;
	?>
	<div class="bold"><?php echo $sender->getResponseType("65") ?> </div> <div><?php echo Messages::ReportTimes; ?> </div>
	<div class="bold"><?php echo $db->numPeople ?> </div> <div><?php echo 65 ?> </div>
	<div class="bold"><?php echo $db->phone ?> </div> <div><?php echo $from ?> </div>
		
</div>	



</body>
</html>