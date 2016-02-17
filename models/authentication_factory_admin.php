<?php

/*
This script is used to authenticate various aspects throughout the website.
*/
class authentication_factory_admin {
	private $employeesDAO;
	public function __construct($employeesDAO) {
		//use the usersDAO in this script
		$this->employeesDAO = $employeesDAO;
	}

	
	public function isUserExisting($email) {
	/*
	  method to authenticate the username that has been entered, by checking if it exists in the database
	*/
		return ($this->customersDAO->isUserExisting( $email ));
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
	public function loginUser($userId, $username, $isUserAdmin) {
	/*
	 Method to hold the session variables of the user that is logged in.
	*/
		$_SESSION ['user_id'] = $userId;
		$_SESSION ['username'] = $username;
		$_SESSION ['isUserAd'] = $isUserAdmin;
	}

	public function isUserAdminFunc(){
		return $_SESSION ['isUserAd'];
	}

	public function getPONumberLoggedIn(){
		$cid = $_SESSION['user_id'];

		return($this->customersDAO->getPONumberLoggedIn($cid)); 
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
	public function logoutUser() {
	/*
	 Log the user out based on the credentials provided during log in
	*/
		unset ( $_SESSION ['user_id'] );
		unset ( $_SESSION ['username'] );
		unset ( $_SESSION ['isUserAd'] );
		// Destroy the current session
		session_destroy ();
	}
}
?>