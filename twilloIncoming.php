<?php

require __DIR__.'/php/twilio-php/Services/Twilio.php';
require __DIR__.'/twillio-config.php';

$client = new Services_Twilio($AccountSid, $AuthToken);
 
$sms = $client->account->sms_messages->create(
    "18563474227", // From this number
    $_REQUEST['From'], // To this number
    "echo ".$_REQUEST['Body']
);


?>
