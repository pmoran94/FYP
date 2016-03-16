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
	
		$sqlQuery = "SELECT emp_id,customer_,subject,content,date_ ";
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
	
	
	public function reportIssue($subject,$content,$userId,$userPO,$date,$username){
	
		$sqlQuery = "INSERT INTO notifications(name,ponumber,subject,content,date_) ";
		$sqlQuery .= "VALUES ('$username','$userPO','$subject','$content','$date' ) ";		
		
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}	

}
?>