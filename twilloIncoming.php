<?php

require __DIR__.'/php/twilio-sender.php';

session_start();

$body = $_REQUEST['Body'];

if(isset($_SESSION['lastMsg'])){
	$lastMsg = $_SESSION['lastMsg'];
}else{
	$lastMsg = Messages::WhatsYourAddress;	
}

$from = $_REQUEST['From'];

$db = new database();
$sender = new twilioSender($lastMsg, $from, $db);

$respType = $sender->getResponseType($body);
$respText = $sender->getReponseText($respType);	
$sender->sendSms($respText);
$_SESSION['lastMsg'] = $respType;


?>
