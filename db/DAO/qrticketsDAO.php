<?php

require_once("dao.php");
class qrticketsDAO extends BaseDAO {

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
	}

	public function insertNewQRCodeTEST($sampleQRTYPE){
		
		
		$sqlQuery = "INSERT INTO qrcodes (type,qrCodeID) ";
		$sqlQuery .= "VALUES ('$sampleQRTYPE') ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}


	
	public function getAllQRCodesForUser()
	{
		return true;
	}
	public function getAllStamps(){
		return true;
	}
	public function getAllParkingTickets(){
		return true;
	}
	public function getAllEvents(){
		return true;
	}
	public function getAllInviteesForEvent(){
		return true;
	}
	public function getAllEventsForUser(){
		return true;
	}
	public function getParkingTicket(){
		return true;
	}
	public function updateParkingTicket(){
		return true;
	}

	public function isQRCodeScannedValid($poNum){
		$sqlQuery = "SELECT ponumber ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE ponumber='$poNum' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL){
			return (true);
		}
		else
			return (false);
	}

	public function retPOofQRCode($ponumber){
		$sqlQuery = "SELECT cemail ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE ponumber='$ponumber' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL) return $result[0]["cemail"];
		return (NULL);

	}
	

	public function isQRCodeIDvalid($qrID){	
		$sqlQuery = "SELECT qrCodeID ";
		$sqlQuery .= "FROM qrcodes ";
		$sqlQuery .= "WHERE qrCodeID='$qrID' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL) return true;
		return false;
	}

	public function getAllQRCodes(){
	
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM orders ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}

	public function insertIntoQRTable($qrType,$stampID){
		$sqlQuery = "INSERT into qrcodes(type,qrCodeID) ";
		$sqlQuery .= "VALUES ('$qrType','$stampID') ";

		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

	public function insertIntoStampTable($destination,$weight,$type,$stampID,$userPO){

		$sqlQuery = "INSERT into stamps(destination,weight,type,stampID,generatedBy) ";
		$sqlQuery .= "VALUES ('$destination','$weight','$type','$stampID','$userPO' ) ";

		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

	public function insertNewEvent($eventCreator,$eventName,$eventDesc,$eventDate,$eventLoc,$noOfInvites,$inviteType,$eventID){
		$sqlQuery = "INSERT into events(creator_id,nameOfEvent,eventDesc,dateOfEvent,eventLocation,no_of_invites,inviteType,eventID) ";
		$sqlQuery .= "VALUES ('$eventCreator','$eventName','$eventDesc','$eventDate','$eventLoc','$noOfInvites','$inviteType','$eventID') ";

		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;

	}


}
?>