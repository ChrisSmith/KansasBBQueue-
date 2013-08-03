<?php

require __DIR__.'/twilio-php/Services/Twilio.php';
require __DIR__.'/../twillio-config.php';
require __DIR__.'/../database.php';
require __DIR__.'/../polls.php';

class Messages
{
    const WhatsYourAddress = 0;
    const ReportTimes = 1;
    const ReportBooths = 2;
    const GetTimes = 3;
    const Thanks = 4;
    const Unknown = 5;
    const Help = 6;
}

class twilioSender {

	public $lastMsg;
	private $fromPhone;
	private $db;
	private $polls;

	public function __construct($lastMsg, $from, $db){
		$this->lastMsg = $lastMsg;
		$this->fromPhone = $from;
		$this->db = $db;
		$this->polls = new Polls();
	}
	
	function sendSms($text, $msgType){

		$client = new Services_Twilio($AccountSid, $AuthToken);
		try{
			$sms = $client->account->sms_messages->create(
			    "18563474227", // From this number
			    $this->fromPhone, // To this number
			    $text
			);
			
		}catch(Exception $e){
			//sms failed :(
		}
	}

	function getResponseType($body){

		$location = $this->db->getLocationForUser($this->fromPhone);
		
		if ($location == null){
			$lookupRes = $this->polls->locate($body);

			if($lookupRes['status'] == 'success'){
				$firstLoc = $result['pollingLocations'][0];
				//save loc / get locationId
				$addr = $poll_location['address'];
				$location = $addr['locationName']
					. $addr['line1'] . ', '
    				. $addr['city'] . ', '
    				. $addr['state'] . ', '
    				. $addr['zip'];
    			//$poll_location['pollingHours'];
    			$this->db->insertAddress($location);
    			return Messages::Help;	
			}
		}

		if($location == null){
			return Messages::WhatsYourAddress;	
		}

		switch($body){
		case "stop":
			//unsubscribe
			break;
		case "h":
		case "help":
			return Messages::Help;
		case "c":
		case "checkin":
			return Messages::ReportTimes;
		case "time":
		case "times":
		case "t":
			return Messages::GetTimes;
		default:
			if($this->lastMsg == Messages::ReportTimes && is_numeric($body)){
				$int = intval($body);
				$this->db->checkIn($this->fromPhone, $int);
				return Messages::ReportBooths;
				
			}else if($this->lastMsg == Messages::ReportBooths && is_numeric($body)){
				$int = intval($body);
				// $this->db->checkIn($this->fromPhone, $int);
				
				return Messages::Thanks;		
			}else{
				return Messages::Unknown;
			}
		}
	}

	function getReponseText($responseType){
		switch($responseType){
			case Messages::Help:
				return "Type 't' to get waiting times or 'c' to report waiting times";
			case Messages::ReportTimes:
				return "How many people are at your polling place?";
			case Messages::GetTimes:
				return "Looks like it'll be 14 minutes right now"; //getTimes($location);
			case Messages::ReportBooths:
				return "Great, how many booths did they have?";
			case Messages::Thanks:
				return "Thanks, tell your friends!";

			default:
			case Messages::Unknown:
				return "Sorry we didn't understand that";
		}
	}

}
?>