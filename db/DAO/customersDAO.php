<?php

require_once("dao.php");
class customersDAO extends BaseDAO {

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
	}
	

	public function isUserExisting( $email ){

		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE cemail='$email' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result[0]["isExisting"] == 1){
			 return (true);}

		else {
			return (false);}
	}

	public function searchResults($parameters){
		$sqlQuery = "SELECT CONCAT(fname,' ',sname) AS name,cmobile,cemail,caddr,ponumber,carRegistration,date_joined ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE ponumber";
		$sqlQuery .= "like '%$parameters%' OR name like '%$parameters%' OR cemail like '%$parameters%' OR caddr like '%$parameters%' OR carRegistration like '%$parameters%'  ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		return $result;
	}
	public function getUserEmail($uid){
		$sqlQuery = "SELECT cemail ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$uid' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result != NULL) return $result[0]["cemail"];
		return (NULL);
	}

	public function changePassword($hashNewPass,$userId){

		$sqlQuery = "UPDATE customers ";
		$sqlQuery .= "SET cpassword='$hashNewPass' ";
		$sqlQuery .= "WHERE id='$userId' ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);

	}

	public function getUserPassword($cid){

		$sqlQuery = "SELECT cpassword ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$cid' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result != NULL) return $result[0]["cpassword"];
		return (NULL);

	}
	

	public function isPOnumValid($poNum){
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

	public function retEmailOfPONum($ponumber){
		$sqlQuery = "SELECT cemail ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE ponumber='$ponumber' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL) return $result[0]["cemail"];
		return (NULL);

	}

	public function getCarRegistration($cid){
		$sqlQuery = "SELECT carRegistration ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$cid' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL) return $result[0]["carRegistration"];
		return (NULL);

	}


	public function getCarRegistrationScanned($ponumber){
		$sqlQuery = "SELECT carRegistration ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE ponumber='$ponumber' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL) return $result[0]["carRegistration"];
		return (NULL);

	}

		


	/*
		Inserting a new user, to the database , using valid username, email and a hashed password
	*/
	public function insertNewCustomer($firstName,$secondName,$mobile,$address,$email,$hashedPassword,$date_joined,$ponumber) {
		
		$sqlQuery = "INSERT INTO customers (fname,sname,cmobile,cemail,caddr,cpassword,ponumber,date_joined) ";
		$sqlQuery .= "VALUES ('$firstName','$secondName','$mobile','$email','$address','$hashedPassword','$ponumber','$date_joined') ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

	public function updateUser_PopulateForm($userId){
		
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$userId' ";
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}

	public function getUserDetails($uid){
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$uid' ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		return $result;

	}

	public function getUserId($email){
		$sqlQuery = "SELECT id ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE cemail='$email' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["id"])) return ($result[0]["id"]);
		else return (false);
	}

	public function getPONumberLoggedIn($cid){
		$sqlQuery = "SELECT ponumber ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$cid' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["ponumber"])) return ($result[0]["ponumber"]);
		else return (false);
	}

	public function getUserName($userId){
		$sqlQuery = "SELECT CONCAT(fname,' ',sname) AS username ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE id='$userId' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["username"])) return ($result[0]["username"]);
		else return (false);
	}
	public function getAllCustomers(){
	
		$sqlQuery = "SELECT id,CONCAT(fname,' ',sname) AS username,cmobile,cemail,caddr,cpassword,ponumber,date_joined ";
		$sqlQuery .= "FROM customers ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}
	
	public function deleteUser($email){
		$sqlQuery = "DELETE FROM customers ";
		$sqlQuery .= "WHERE cemail = '$email' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
	}
		
		

	
	public function getUserPasswordDigest($email) {
		$sqlQuery = "SELECT cpassword ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE cemail='$email' ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result != NULL) return $result[0]["cpassword"];
		return (NULL);
	}
}
?>