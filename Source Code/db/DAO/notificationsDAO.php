<?php
require_once("dao.php");
class notificationsDAO extends BaseDAO{

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
	}
	
	
	public function getAllCustomerIssues(){
	
		$sqlQuery = "SELECT name,ponumber,subject,content,date_ ";
		$sqlQuery .= "FROM notifications ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}
	public function getAllEmployeeIssues(){
	
		$sqlQuery = "SELECT emp_id,subject,content,date_ ";
		$sqlQuery .= "FROM notifications ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}

	
	public function reportIssue($subject,$content,$userId,$userPO,$date,$username){
	
		$sqlQuery = "INSERT INTO notifications(name,ponumber,subject,content,date_) ";
		$sqlQuery .= "VALUES ('$username','$userPO','$subject','$content','$date' ) ";		
		
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}	
	public function contactCustomerByNotification($ponumber,$subject,$content,$employee){
		$sqlQuery = "INSERT into notificationmessages(ponumber,subject,content,employee) ";
		$sqlQuery .= "VALUES('$ponumber','$subject','$content','$employee') ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

}
?>