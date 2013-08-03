<?php

require __DIR__.'/php/twilio-php/Services/Twilio.php';
require __DIR__.'/twillio-config.php';

/*
Defined in twillio-config.php
$AccountSid = "";
$AuthToken = "";
*/

$client = new Services_Twilio($AccountSid, $AuthToken);
 
try {
    $sms = $client->account->sms_messages->create(
        "", // From this number
        "", // To this number
        "Test message!"
    );
} catch (Services_Twilio_RestException $e) {
    echo $e->getMessage();
}

?>

Done!