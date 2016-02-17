<?php

require_once("dao.php");
class qrticketsDAO extends BaseDAO {

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
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
	


	/*
		Inserting a new user, to the database , using valid username, email and a hashed password
	*/
	public function insertNewOrder($username,$ponumber,$envs,$stickers,$date_ordered,$cost) {
		
		$sqlQuery = "INSERT INTO orders (username,ponumber,envelopes,stickers,date_ordered,cost) ";
		$sqlQuery .= "VALUES ('$username','$ponumber','$envs','$stickers','$date_ordered','$cost') ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

	public function getAllOrders(){
	
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM orders ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}

}
?>