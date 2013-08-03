<?php

require '/twilio-php/Services/Twilio.php';
require '/twillio-config.php';

/*
Defined in twillio-config.php
$AccountSid = "";
$AuthToken = "";
*/

$client = new Services_Twilio($AccountSid, $AuthToken);
 
try {
    $sms = $client->account->sms_messages->create(
        "YYY-YYY-YYYY", // From this number
        "XXX-XXX-XXXX", // To this number
        "Test message!"
    );
} catch (Services_Twilio_RestException $e) {
    echo $e->getMessage();
}

?>