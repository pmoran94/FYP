<?php

require_once("dao.php");
class employeesDAO extends BaseDAO {

	function messagesDAO($dbMng) {
		parent::BaseDAO($dbMng);
	}
	

	public function isEmpExisting( $empNum ){

		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE emp_no='$empNum' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result[0]["isExisting"] == 1){
			 return (true);}

		else {
			return (false);}
	}




	public function changePin($hashNewPin,$userId){

		$sqlQuery = "UPDATE employees ";
		$sqlQuery .= "SET emp_pin='$hashNewPin' ";
		$sqlQuery .= "WHERE e_id='$userId' ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);

	}

	public function getEmployeeService($uid,$service){
		$sqlQuery = "SELECT service ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE service='$service' ";

		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		if ($result != NULL) return $result[0]["service"];
		return (NULL);
	}

	public function getUserPin($e_id){

		$sqlQuery = "SELECT emp_pin ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE e_id='$e_id' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result != NULL) return $result[0]["emp_pin"];
		return (NULL);

	}
	
	public function isAdminEmailExisting( $email ){

		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE email='$email' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result[0]["isExisting"] == 1){
			 return (true);}

		else {
			return (false);}
	}

	public function isEmpNumValid($empNum){
		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE emp_no='$empNum' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result[0]["isExisting"] == 1){
			 return (true);}

		else {
			return (false);}
	}
	
	public function isUserLoggedInAdmin($e_id){
		$sqlQuery = "SELECT is_admin " ;
		$sqlQuery .= "FROM employees " ;
		$sqlQuery .= "WHERE e_id='$e_id' " ;  
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);


		if ($result[0]["is_admin"] == 'yes') return (true);
		else return (false);

	}

	public function insertNewEmployee( $firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin,$date_joined,$empNum,$companyID, $service) {
		
		$sqlQuery = "INSERT INTO employees (fname,sname,dob,mobile,address,email,emp_no,emp_pin,date_employed,companyID,service) ";
		$sqlQuery .= "VALUES ('$firstName','$secondName','$dob','$mobile','$address','$email','$empNum','$hashedPin','$date_joined','$companyID', '$service') ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

	public function updateEmployee($EmpNo,$firstname,$surname,$emp_pin){
		
		$sqlQuery = "UPDATE employees ";
		$sqlQuery .= "SET fname='$firstname' , sname='$surname', emp_pin='$EmpPin' ";
		$sqlQuery .= "WHERE emp_no='$EmpNo' ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);
	}

	public function getEmpNumberLoggedIn($eid){
		$sqlQuery = "SELECT emp_no ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE e_id='$eid' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["emp_no"])) return ($result[0]["emp_no"]);
		else return (false);
	}

	public function getAdminId($empNum){
		$sqlQuery = "SELECT e_id ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE emp_no='$empNum' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["e_id"])) return ($result[0]["e_id"]);
		else return (false);
	}
	
	public function getAdminUserName($userId){
		$sqlQuery = "SELECT CONCAT(fname,' ',sname) AS username ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE e_id='$userId' ";	
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		if (!empty($result[0]["username"])) return ($result[0]["username"]);
		else return (false);
	}
	public function getAllEmployees(){
	
		$sqlQuery = "SELECT e_id,CONCAT(fname,' ',sname) AS username,is_admin,dob,mobile,address,email,emp_no,date_employed ";
		$sqlQuery .= "FROM employees ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		return $result; 
	}
	
	public function getEmployeeDetails($uid){
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE e_id='$uid' ";
		
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
			
		return $result;

	}

	public function deleteEmployee($eid){
		$sqlQuery = "DELETE FROM employees ";
		$sqlQuery .= "WHERE e_id = '$eid' ";		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeQuery($sqlQuery);
	}		
	public function makeAdmin($eid){
		$sqlQuery = "UPDATE employees ";
		$sqlQuery .= "SET is_admin='yes' ";
		$sqlQuery .= "WHERE e_id='$eid' ";
		$result = $this->getDbManager()->executeQuery($sqlQuery);
		return $result;
	}

	
	public function getUserPinDigest($empNum) {
		$sqlQuery = "SELECT emp_pin ";
		$sqlQuery .= "FROM employees ";
		$sqlQuery .= "WHERE emp_no='$empNum' ";
		
		//Calls the method from the DAOFactory and passes in the query to be  execute, and the result is stored
		$result = $this->getDbManager()->executeSelectQuery($sqlQuery);
		
		if ($result != NULL) return $result[0]["emp_pin"];
		return (NULL);
	}
}
?>