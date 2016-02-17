<?php

// calling use of the the dao.php script in order to extend the BaseDAO method

/*
The usersDAO mainly uses various methods located in the DAO Factory and dao.
From here, the sql queries are defined, and called mainly from the model.

FOR EXAMPLE.    Controller -> model ->usersDAO ->DAO_factory->simple_db_manager


require_once("dao.php");
class usersDAO extends BaseDAO {

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
	}
}
	
	
	// Query to check if there is records in the database of the query entered
	
	public function isUserExisting($username){
		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE username='$username' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result[0]["isExisting"] == 1) return (true);
		else return (false);
	}
	
	public function updateUser($username,$hashedPassword,$email){
		
		$sqlQuery = "UPDATE customers ";
		$sqlQuery .= "SET username='$username' , password='$hashedPassword' , email='$email' ";
		$sqlQuery .= "WHERE username='$username' ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		
		
	}
	
	// Query to select the id from the database where the name matches the username entered
	
	public function getUserId($username){
		$sqlQuery = "SELECT id ";
		$sqlQuery .= "FROM users ";
		$sqlQuery .= "WHERE username='$username' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["id"])) return ($result[0]["id"]);
		else return (false);
	}
	
	public function getAllUsers(){
	
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM users ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}
	
	public function deleteUser($username){
		$sqlQuery = "DELETE FROM users ";
		$sqlQuery .= "WHERE username = '$username' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
	
	}
	
	public function isPOnumValid($poNum){
		$sqlQuery = "SELECT ponumber ;"
		$sqlQuery .= "FROM customers ";
		$sqlQuery .= "WHERE ponumber='$poNum' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);

		if ($result != NULL){
			return (true);
		}
		else
			return (false);
	}
	
	
	// Query to return the password which matches the username which has been entered.
	// This query will return the hash password value, in order to be compared with the one the user has entered to check of authentic crendentials for log in.
	
	public function getUserPasswordDigest($username) {
		$sqlQuery = "SELECT password ";
		$sqlQuery .= "FROM users ";
		$sqlQuery .= "WHERE username='$username' ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result != NULL) return $result[0]["password"];
		return (NULL);
	}
	
	
	
	//	Inserting a new user, to the database , using valid username, email and a hashed password
	
	public function insertNewUser($username,$email, $passwordHash) {
		$sqlQuery = "INSERT INTO users (username,email, password) ";
		$sqlQuery .= "VALUES ('$username','$email', '$passwordHash') ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}
	
	
}
*/

?>