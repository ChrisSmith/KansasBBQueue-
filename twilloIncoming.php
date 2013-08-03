<?php

require __DIR__.'/php/twilio-sender.php';

session_start();

$body = $_REQUEST['Body'];
$lastMsg = $_SESSION['lastMsg'];
$from = $_REQUEST['From'];

if($lastMsg == null){
	$lastMsg = Messages::WhatsYourAddress;	
} 

$db = new database();
$sender = new twilioSender($lastMsg, $from, $db);

$respType = $sender.getResponseType($body);
$respText = $sender.getReponseText($respType);	
$_SESSION['lastMsg'] = $respType;

?>
