<?php
require 'polls.php';
$address = '1263 Pacific Ave. Kansas City KS';
$polls = new Polls();
$result = $polls->locate($address);

if($result['status'] == 'success') {
  foreach ($result['pollingLocations'] as $poll_location) {
    echo $poll_location['address']['locationName'];
    echo $poll_location['address']['line1'];
    echo $poll_location['address']['city'];
    echo $poll_location['address']['state'];
    echo $poll_location['address']['zip'];
    echo $poll_location['pollingHours'];
  }
}

?>
