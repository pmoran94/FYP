<?php
require_once("dao.php");
class notificationsDAO extends BaseDAO{

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
	}
	
	
	public function getAllIssues(){
	
		$sqlQuery = "SELECT id,name,ponumber,subject,content,date_ ";
		$sqlQuery .= "FROM notifications ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}
	
	public function deleteRecord($mID){
		$sqlQuery = "DELETE FROM notifcations ";
		$sqlQuery .= "WHERE id = '$mID' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
	
	}
	
	public function searchResults($parameters){
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM notifications ";
		$sqlQuery .= " WHERE id ";
		$sqlQuery .= "like '%$parameters%' OR name like '%$parameters%' OR description like '%$parameters%' OR rating like '%$parameters%'  ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	
	public function updateRecord($mID,$mName,$mDesc,$mRate){
		
		$sqlQuery = "UPDATE notifications ";
		$sqlQuery .= "SET name='$mName' , description='$mDesc' , rating='$mRate' ";
		$sqlQuery .= "WHERE id='$mID' ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);		
	}
	
	public function reportIssue($subject,$content,$userId,$userPO,$date,$username){
	
		$sqlQuery = "INSERT INTO notifications(name,ponumber,subject,content,date_) ";
		$sqlQuery .= "VALUES ('$username','$userPO','$subject','$content','$date' ) ";		
		
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}	

}
?>