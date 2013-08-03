<?php

require __DIR__.'/php/twilio-php/Services/Twilio.php';
require __DIR__.'/twillio-config.php';
require __DIR__.'/php/database.php';

function sendSms($text, $msgType){
	$usersPhone = $_REQUEST['From'];
	$client = new Services_Twilio($AccountSid, $AuthToken);
	try{
		$sms = $client->account->sms_messages->create(
		    "18563474227", // From this number
		    $usersPhone, // To this number
		    $text
		);
	
		$_SESSION['lastMsg'] = $msgType;
	}catch(){
		//sms failed :(
	}
}

class Messages
{
    const WhatsYourAddress = 0;
    const ReportTimes = 1;
    const ReportBooths = 1;
    const GetTimes = 2;
    const Thanks = 3;
}

session_start();

$lastMsg = $_SESSION['lastMsg'];
if($lastMsg == null){
	$lastMsg = Messages::WhatsYourAddress;	
} 

$body = $_REQUEST['Body'];

$location = getLocationForUser($usersPhone);

if ($location == null){
	$location = getPollingLocationForAddress($body);
}

if($location == null){
	sendSms("Reply with your address");
}else{

	switch($body){
		case "c":
		case "checkin":
			sendSms("How many people are at your polling place?", Messages::ReportTimes);
			break;
		case "time":
		case "times":
		case "t":
			$times = getTimes($location);		
			sendSms($times, Messages::GetTimes);
			break;
		default:

			if($lastMsg == Messages::ReportTimes && is_numeric($body)){
				//user sent in the number of people at the polling location
				sendSms("Great, how many booths did they have?", Messages::ReportBooths);

			}else if($lastMsg == Messages::ReportBooths && is_numeric($body)){
			
				sendSms("Thanks, tell your friends!", Messages::Thanks);
			}
	}

}


?>
