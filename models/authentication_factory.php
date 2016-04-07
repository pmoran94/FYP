<?php
/*
This script is used to authenticate various aspects throughout the website.
*/
class authentication_factory {
	private $customersDAO;
	private $employeesDAO;

	public function __construct($customersDAO,$employeesDAO) {
		//use the usersDAO in this script
		$this->customersDAO = $customersDAO;
		$this->employeesDAO = $employeesDAO;
	}

	public function passwordOfUserLoggedIn(){
		$cid = $_SESSION['user_id'];

		return($this->customersDAO->getUserPassword($cid));
	}

	public function pinOfUserLoggedIn(){
		$e_id = $_SESSION['user_id'];

		return($this->employeesDAO->getUserPin($e_id));


	}
	public function passwordVerificationOfUserLoggedIn($userPassword){

		$dbHashPassword = $this->passwordOfUserLoggedIn();
		$userHashedPassword = $this->getHashValue($userPassword);

		if($dbHashPassword == $userHashedPassword){
			return (true);
		}
		else 
			return(false);
	}

	public function pinVerificationOfUserLoggedIn($userPin){

		$dbHashPin = $this->pinOfUserLoggedIn();
		$userHashedPin = $this->getHashValue($userPin);

		if($dbHashPin == $userHashedPin){
			return (true);
		}
		else 
			return(false);
	}
	

	public function isUserLoggedInAdmin(){

		$e_id = $_SESSION['user_id'];

		return($this->employeesDAO->isUserLoggedInAdmin($e_id));
	}

	public function isUserExisting($email) {
	/*
	  method to authenticate the username that has been entered, by checking if it exists in the database
	*/
		return ($this->customersDAO->isUserExisting( $email ));
	}

	public function isAdminEmailExisting($email) {
	/*
	  method to authenticate the username that has been entered, by checking if it exists in the database
	*/
		return ($this->employeesDAO->isAdminEmailExisting( $email ));
	}

	public function isAdminExisting($empNum) {
	/*
	  method to authenticate the username that has been entered, by checking if it exists in the database
	*/
		return ($this->employeesDAO->isAdminExisting( $empNum ));
	}

	
	public function insertNewUser($username, $password) {
	/*
	  method to insert a new user to the database, using the new username entered, and the hash value of the password which has been entered in.
	*/
		$hashedPassword = hash ( "sha1", $password );
		return ($this->usersDAO->insertNewUser ( $username, $hashedPassword ));


	}
	public function getHashValue($string) {
	/*
	 This method is used to attain the hash value of a password and return it, it is used to compare the password entered on log in to the one in the database.
	*/
		return (hash ( "sha1", $string ));
	}
	public function loginUser($userId, $username, $isUserEmploy) {
	/*
	 Method to hold the session variables of the user that is logged in.
	*/
		$_SESSION ['user_id'] = $userId;
		$_SESSION ['username'] = $username;
		$_SESSION ['isUserEmploy'] = $isUserEmploy;
	}

	public function isUserEmployee(){
		
		return($_SESSION ['isUserEmploy']);
	}
	public function setEventID($eventID){
		$_SESSION['eventID'] = $eventID ;
	}



	public function getPONumberLoggedIn(){
		$cid = $_SESSION['user_id'];

		return($this->customersDAO->getPONumberLoggedIn($cid)); 
	}

	public function getCarRegistration(){
		$cid = $_SESSION['user_id'];

		return($this->customersDAO->getCarRegistration($cid));
	}

	public function getEmpNumberLoggedIn(){
		$eid = $_SESSION['user_id'];

		return($this->employeesDAO->getEmpNumberLoggedIn($eid)); 
	}

	public function isUserLoggedIn() {
	/*
		Method checks if the user is logged in (if the user logged in exists)
		Returns boolean  value
	*/
		return (! empty ( $_SESSION ['user_id'] ));
	}
	public function getUsernameLoggedIn() {
		/*Returns the name of the user logged in*/
		if ($this->isUserLoggedIn())
			return $_SESSION ['username'];
		
		return (null);
	}
	public function getIDLoggedIn() {
		/*Returns the name of the user logged in*/
		if ($this->isUserLoggedIn())
			return $_SESSION ['user_id'];
		
		return (null);
	}
	public function logoutUser() {
	/*
	 Log the user out based on the credentials provided during log in
	*/
		unset ( $_SESSION ['user_id'] );
		unset ( $_SESSION ['username'] );
		unset ($_SESSION ['isUserEmploy']);
		unset ($_SESSION ['eventID']);
		// Destroy the current session
		session_destroy ();
	}







	/**


	THE FOLLOWING METHODS ARE CALLED WHEN QR CODE IS SCANNED


	**/


	public function getCarRegistrationOfScannedTicket($ponumber){

		return $this->customersDAO->getCarRegistrationScanned($ponumber) ;

	}

}
?>