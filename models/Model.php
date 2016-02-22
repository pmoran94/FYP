<?php

/*
The model the main point of interaction between all the components
*/
/*
----Include various scripts (factories , DAOS, and configuration file)
*/
include_once './conf/config.inc.php';
include_once './db/DAO_factory.php';
include_once 'validation_factory.php';
include_once 'authentication_factory.php';
include_once 'authentication_factory_admin.php';
include_once 'validation_factory_admin.php';


class Model {
	public $DAO_Factory,$adminValidationFactory,$adminAuthenticationFactory, $validationFactory, $authenticationFactory,$dataHandler; // factories
	private $qrticketsDAO,$customersDAO,$employeesDAO,$notificationsDAO; // DAOs
	public $appName = "", $introMessage = "", $loginStatusString = "",$userDetails = "", $rightBox = "",$displayTables = "", $signUpConfirmation="",$middleBox = "", $allUsers="",$allIssues="",$allEmployees="",
	$searchResults=""; // strings
	public $newUserErrorMessage = "", $authenticationErrorMessage = "";	//error messages
	public $hasAuthenticationFailed = false, $hasRegistrationFailed=null;	//control variables
	
	
	public function __construct() {
		/*
		 Assigning various factories , DAOS, strings, error messages, and control variables
		*/
		
		$this->DAO_Factory = new DAO_Factory ();
		$this->DAO_Factory->initDBResources ();
		$this->customersDAO = $this->DAO_Factory->getCustomersDAO();
		$this->employeesDAO = $this->DAO_Factory->getEmployeesDAO();
		$this->qrticketsDAO = $this->DAO_Factory->getQRTicketsDAO();
		$this->notificationsDAO = $this->DAO_Factory->getNotificationsDAO();
		$this->authenticationFactory = new authentication_factory ( $this->customersDAO, $this->employeesDAO );
		$this->validationFactory = new validation_factory ( $this->customersDAO , $this->employeesDAO );
		$this->appName = APP_NAME;

	}
	
	/*
		CUSTOMER LOG IN METHODS
	*/

	public function loginUser($userId, $username,$isUserEmploy) {
		$this->authenticationFactory->loginUser ( $userId, $username,$isUserEmploy);
	}
	public function getUserPasswordDigest($email) {
		return ($this->customersDAO->getUserPasswordDigest ( $email ));
	}
	public function getUserID($email) {
		return ($this->customersDAO->getUserId( $email ));
	}
	public function getUserName($userId){
		return ($this->customersDAO->getUserName ($userId));
	}
	public function insertNewCustomer($firstName,$secondName,$mobile,$address,$email,$hashedPassword,$date_joined,$ponumber,$ac_amount) {
		return ($this->customersDAO->insertNewCustomer ( $firstName,$secondName,$mobile,$address,$email,$hashedPassword,$date_joined,$ponumber,$ac_amount ));
	}
	public function updateUserForm($userId){
		$result = $this->customersDAO->updateUser_PopulateForm($userId);
		$_SESSION['updateUserData'] = $result;
	}
	public function compareEmailToPO($ponumber){
		return ($this->customersDAO->retEmailOfPONum($ponumber));
	}
	public function deleteUser($email){
		$this->customersDAO->deleteUser($email);
	}
	public function changePassword($hashNewPass,$userId){
		$this->customersDAO->changePassword($hashNewPass,$userId);
	}
	public function makeOrder($username,$ponumber,$envs,$stickers,$date_ordered,$cost){
		$this->qrticketsDAO->insertNewOrder($username,$ponumber,$envs,$stickers,$date_ordered,$cost);
	}

	public function reportIssue($subject,$content,$userId,$userPO,$date,$username){

		$this->notificationsDAO->reportIssue($subject,$content,$userId,$userPO,$date,$username);
	}
	/*
		EMPLOYEE LOG IN METHODS
	*/
	public function getUserPinDigest($empNum) {
		return ($this->employeesDAO->getUserPinDigest ( $empNum ));
	}
	public function getAdminID($empNum) {
		return ($this->employeesDAO->getAdminId( $empNum ));
	}	
	public function getAdminUserName($userId){
		return ($this->employeesDAO->getAdminUserName($userId));
	}
	public function insertNewEmployee( $firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin , $date_joined, $empNum , $is_admin) {	
		return ($this->employeesDAO->insertNewEmployee($firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin,$date_joined, $empNum, $is_admin));
	}
	public function deleteEmployee($username){
		$this->employeesDAO->deleteEmployee($username);
	}
	public function changePin($hashNewPin,$userId){
		$this->employeesDAO->changePin($hashNewPin,$userId);
	}
	/*
		OTHER METHODS TO BE FIXED
	*/

	public function getUserDetails(){
		$uid = $_SESSION['user_id'];
		$this->userDetails = $this->customersDAO->getUserDetails($uid);
	}
	
	public function getAllUsers(){
	
		$this->allUsers =  $this->customersDAO->getAllUsers();
	}
	
	//public function getAllOrders(){
//		$this->allOrders = $this->qrticketsDAO->getAllOrders();
	//}
	public function getAllIssues(){
		$this->allIssues = $this->notificationsDAO->getAllIssues();
	}
	public function getAllEmployees(){
		$this->allEmployees = $this->employeesDAO->getAllEmployees();
	}
	public function search($parameters){
		$this->searchResults = $this->contentDAO->searchResults($parameters);
	}
	
	
	
	public function prepareIntroMessage() {
		/*
		-- Method to get the intro message gotten from the config.inc.php script
		*/
		$this->introMessage = INDEX_INTRO_MESSAGE_STR;
	}

	public function setUpNewUserError($errorString) {
	// method to notify user of a an error occuring during insert new user form.
		$this->newUserErrorMessage = "<div class='alert alert-error'>" . $errorString . "</div>";
	}
	public function updateLoginStatus() {
	
		/*
		--method to update the login status of a user.
		This mainly just overwrites the login screen string
		Here Authentication error message is set to null.
		-to prevent both from appearing on screen
		*/
		$this->loginStatusString = LOGIN_USER_FORM_WELCOME_STR . " " . $this->authenticationFactory->getUsernameLoggedIn() . " | " . LOGIN_USER_FORM_LOGOUT_STR;
		$this->authenticationErrorMessage = "";
	}
	public function updateLoginErrorMessage() {
		/*
		--Method to update the login error message.
		Here the loginStatusString is set to null instead.
		-to prevent both from appearing on screen
		*/
		$this->authenticationErrorMessage = LOGIN_USER_FORM_AUTHENTICATION_ERROR;
		$this->loginStatusString = "";
	}
	public function setConfirmationMessage(){
		/*
		--The model uses this method to assign the confirmation message that the new user is now successfully set up.
		*/
		$this->signUpConfirmation = NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR;
	}

	public function logoutUser() {
		/*
			This is the method to control user log out.
			It sets the login status to null and the empties the authentication error message.
			But also from here the logoutUser is method is called from the authenticationFactory -
			from here the session variables will be unset and the current session will be destroyed.
		*/
		$this->authenticationFactory->logoutUser ();
		$this->loginStatusString = null;
		$this->authenticationErrorMessage = "";
	}
	
	public function isUserLoggedIn() {
		/*
			The method is to check if there is a user logged in.
			It will receive a boolean value to know if there is a user logged in or not
		*/
		return ($this->authenticationFactory->isUserLoggedIn ());
	}	


	
	/*

		THIS NEEDS TO BE MOVED TO THE AUTHENTICATION FACTORY

	*/
	public function isUserLoggedInAdmin(){

		$e_id = $_SESSION['user_id'];
		if($this->employeesDAO->isUserLoggedInAdmin($e_id)){
			return(true);
		}else return (false);
	}
	public function __destruct() {
		/*
			This is models method to close the database connection through the DAOFactory, which calls the closeConnection method
			from the dbmanager..
		*/
		$this->DAO_Factory->clearDBResources ();
	}
	
}
?>