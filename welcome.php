

  <?php
  require 'polls.php';
  	function userAddress(){
  		$addressstring = $_POST["street-num"]." ".$_POST["city"]." ".$_POST["state"];
    //var_dump($addressstring);
  	return $addressstring;

  	}
    
	function pollingLocation(){
	$address = $_POST["street-num"]." ".$_POST["city"]." ".$_POST["state"];
	$polls = new Polls();
	$result = $polls->locate($address);

	if($result['status'] == 'success') {
		//var_dump($result['pollingLocations']);
	  foreach ($result['pollingLocations'] as $poll_location) {
	    echo "Location Name: ".$poll_location['address']['locationName'];
	    echo "<br>Address: ".$poll_location['address']['line1'];
	    echo "<br>City: ".$poll_location['address']['city'];
	    echo "<br>State: ".$poll_location['address']['state'];
	    echo "<br>Zip: ".$poll_location['address']['zip'];
	    //echo "<br>Polling Hours: ".$poll_location['pollingHours'];
	  }
	}

	}
	
	?>


