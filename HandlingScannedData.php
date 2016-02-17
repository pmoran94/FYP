<?php
 

include 'models/Model.php'

class data_handler{

	private $model;

	public function __construct() {
		//use the usersDAO in this script
		$this->model = new model();
	}
	
	// $scannedData is the data which is stored in the QR Code.

	$scannedData = "";

	$dataType = substr($scannedData,0,5);
	$userPO = substr($scannedData,6,13);
	$timeOfGen = substr($scannedData,13);

	$carRegistration = $this->model->authenticationFactory->getCarRegistrationScanned($userPO) ;
	$parkingTicketTime = "";


	$invitee = "";
	$eventID = "";
	$ticketID = "";
	$typeOfEntree = "";
	$ticket = "";

	if($dataType == "STAMP"){
		scannedStamp($userPO,$timeOfGen);
	}
	else if ($dataType == "CPARK"){
		scannedCpark($userPO,$timeOfGen,$carRegistration);
	}	
	else if($dataType == "EVENT"){
		scannedEvent($scannedData);
	}
	else
		$scannedData = "";


	function scannedStamp($userPO,$timeOfGen){

		//check the time validation of the stamp (is it too old?)

		//check has this stamp been scanned before, and how many times.
			// Scanned on Departure
			// Scanned on Arrival

		// 
	}
	function scannedCpark($userPO,$timeOfGen,$carRegistration){

		//check the registration

		// check the time of generation, time of top up, amount topped up, time of expiry. 

	}
	function scannedEvent(){

	}
}


?>