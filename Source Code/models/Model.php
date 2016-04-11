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


class Model {
	public $DAO_Factory, $validationFactory, $authenticationFactory,$dataHandler; // factories
	private $qrticketsDAO,$customersDAO,$employeesDAO,$notificationsDAO; // DAOs
	public $appName = "", $introMessage = "", $loginStatusString = "",$userDetails = "",$employeeDetails="", $rightBox = "",$displayTables = "", $signUpConfirmation="",$middleBox = "", $allCustomers="",$allCustomerIssues="",$allEmployees="",$allStamps="",$allCParkTickets="",$allEvents="",$allInviteesForEvent="",$allEventsForUser="",$eventDetails="",$searchResults="",$allCompanyNames="",$getScannedDataForEmployee="",$trackStampsForCustomer = "",$getAllQRs=""; // strings
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
		$this->validationFactory = new validation_factory ( $this->customersDAO , $this->employeesDAO ,$this->qrticketsDAO );
		$this->appName = APP_NAME;

	}


	/*
	
		OTHER METHODS 
	
	*/

	// Method to retrieve the hashed pin value from the database.
	public function getUserPinDigest($empNum) {
		return ($this->employeesDAO->getUserPinDigest ( $empNum ));
	}
	// Method to retrieve the Employee/Admin ID
	public function getAdminID($empNum) {
		return ($this->employeesDAO->getAdminId( $empNum ));
	}	
	// Method to retrieve the Employee/Admin Username
	public function getAdminUserName($userId){
		return ($this->employeesDAO->getAdminUserName($userId));
	}
	// Method to insert a new Employee
	public function insertNewEmployee( $firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin , $date_joined, $empNum ,$companyID, $service) {	
		return ($this->employeesDAO->insertNewEmployee($firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin,$date_joined, $empNum,$companyID, $service));
	}
	// Method to delete an Employee
	public function deleteEmployee($eid){
		$this->employeesDAO->deleteEmployee($eid);
	}
	// Method to change an employee/admin pin
	public function changePin($hashNewPin,$userId){
		$this->employeesDAO->changePin($hashNewPin,$userId);
	}
	// Method to upgrade a regular employee to admin.
	public function makeAdmin($eid){
		return $this->employeesDAO->makeAdmin($eid);
	}

	// Method to get the hashed password value for the customer log in.
	public function getUserPasswordDigest($email) {
		return ($this->customersDAO->getUserPasswordDigest ( $email ));
	}
	// Method to get the User ID logged in.
	public function getUserID($email) {
		return ($this->customersDAO->getUserId( $email ));
	}
	// Methid to get the Username Logged In
	public function getUserName($userId){
		return ($this->customersDAO->getUserName ($userId));
	}
	// Method to Insert a New Customer
	public function insertNewCustomer($firstName,$secondName,$mobile,$address,$email,$hashedPassword,$date_joined,$ponumber) {
		return ($this->customersDAO->insertNewCustomer ( $firstName,$secondName,$mobile,$address,$email,$hashedPassword,$date_joined,$ponumber ));
	}
	// Method to populate a the Update user details form using a temporary session variable.
	public function updateUserForm($userId){
		$result = $this->customersDAO->updateUser_PopulateForm($userId);
		$_SESSION['updateUserData'] = $result;
	}
	// Method to check that the email address entered matches the PO number of that user.
	public function compareEmailToPO($ponumber){
		return ($this->customersDAO->retEmailOfPONum($ponumber));
	}
	// Method to delete customer from database.
	public function deleteCustomer($custID){
		return $this->customersDAO->deleteUCustomer($custID);
	}
	// Method to change a customers password for login.
	public function changePassword($hashNewPass,$userId){
		$this->customersDAO->changePassword($hashNewPass,$userId);
	}
	// Method for a customer to report an issue.
	public function reportIssue($subject,$content,$userId,$userPO,$date,$username){
		$this->notificationsDAO->reportIssue($subject,$content,$userId,$userPO,$date,$username);
	}
	

	/*

		Methods to Populate Views

	*/

	// Method to get all the stamps generated by a particular customer
	public function getStampsForCustomer(){
		if(! empty($_SESSION['user_id'])) $uid = $_SESSION['user_id'];
		else $uid ='';
		$po = $this->customersDAO->getPONumberLoggedIn($uid);
		$this->trackStampsForCustomer = $this->qrticketsDAO->getStampsForCustomer($po);
	}
	// Method to get all the QR data for the admin.
	public function getAllQRs(){
		$this->getAllQRs = $this->qrticketsDAO->getAllQRs();
	}
	// Method to get all the issues which customers have reported
	public function getAllCustomerIssues(){
		$this->allCustomerIssues = $this->notificationsDAO->getAllCustomerIssues();
	}
	// Method to get all employees details
	public function getAllEmployees(){
		$this->allEmployees = $this->employeesDAO->getAllEmployees();
	}
	// Method to get all details for a particular user.
	public function getUserDetails(){
		$uid;
		if(! empty($_SESSION['user_id'])) $uid = $_SESSION['user_id'];
		else $uid = "";
		$this->userDetails = $this->customersDAO->getUserDetails($uid);
	}
	// Method to get all an employees details
	public function getEmployeeDetails(){
		$uid;
		if(! empty($_SESSION['user_id'])) $uid = $_SESSION['user_id'];
		else $uid = "";
		$this->employeeDetails = $this->employeesDAO->getEmployeeDetails($uid);
	}
	//Method to populate table to view all customers
	public function getAllCustomers(){
	
		$this->allCustomers =  $this->customersDAO->getAllCustomers();
	}
	// Method to populate table to view all stamp data.
	public function getAllStamps(){
		$this->allStamps = $this->qrticketsDAO->getAllStamps();
	}
	// Method to populate table to view all parking ticket data.
	public function getAllParkingTickets(){
		$this->allCParkTickets = $this->qrticketsDAO->getAllParkingTickets();
	}
	// Method to populate table with details for all events
	public function getAllEvents(){
		$this->allEvents = $this->qrticketsDAO->getAllEvents();
	}
	// Method to populate table with information of all invitees for an event.
	public function getInviteesForEvent($ev_Id){
		$this->allInviteesForEvent = $this->qrticketsDAO->getInviteesForEvent($ev_Id);
	}
	// Method to get all events in which a particular user is invited to or hosting.
	public function getAllEventsForUser(){
		$uid;
		if(! empty($_SESSION['user_id'])) $uid = $_SESSION['user_id'];
		else $uid = "";
		$userEmail = $this->customersDAO->getUserEmail($uid);
		$this->allEventsForUser = $this->qrticketsDAO->getAllEventsForUser($uid,$userEmail);
	}
	// Method to get all the details for a particular event.
	public function getAllDetailsForEvent($eid){
		$this->eventDetails = $this->qrticketsDAO->getAllDetailsForEvent($eid);
	}
	// Method to get the the data from the database which an particular employee has scanned. This matches only their service. 
	public function getScannedDataForEmployee(){
		if(! empty($_SESSION['user_id'])) $eid = $_SESSION['user_id'];
		else $eid ='';
		$this->getScannedDataForEmployee = $this->qrticketsDAO->getScannedDataForEmployee($eid);
	}

	/*

		Methods for Employee

	*/
	// Method to contact customer by means of online notification
	public function contactCustomerByNotification($ponumber,$subject,$content){
		$uid = $_SESSION['user_id'];
		$employee = $this->employeesDAO->getEmpNumberLoggedIn($uid);
		$res = $this->notificationsDAO->contactCustomerByNotification($ponumber,$subject,$content,$employee);
	}
	// Method to retrieve the service provided by a particular employee.
	public function getEmployeeService(){
		if(! empty($_SESSION['user_id'])) $uid = $_SESSION['user_id'];
		else $uid = "";
		return($this->employeesDAO->getEmployeeService($uid));
	}
	// Method to search customers and populate view.
	public function searchCustomers($parameters){
		$this->searchResults = $this->customersDAO->searchResults($parameters);
	}
	/*

		QR Code Generation Methods

	*/
	// Method to insert event data to database.
	public function createEvent($eventCreator,$eventName,$eventDesc,$eventDate,$eventLoc,$noOfInvites,$inviteType,$eventID,$dateOfCreation){
		return ($this->qrticketsDAO->insertNewEvent($eventCreator,$eventName,$eventDesc,$eventDate,$eventLoc,$noOfInvites,$inviteType,$eventID,$dateOfCreation));
	}
	// Method to insert invites data to database
	public function sendInvites($name,$email,$eventID,$inviteID){
		return ($this->qrticketsDAO->insertIntoInvitesTable($name,$email,$eventID,$inviteID));
	}
	// Method to insert stamp data to database
	public function createStamp($destination,$weight,$type,$stampID,$userPO){
		return ($this->qrticketsDAO->insertIntoStampTable($destination,$weight,$type,$stampID,$userPO));
	}
	// Method to insert parking ticket data to database
	public function createParkingTicket($userID,$dateOfCreation,$ticketID,$initialExpiryTime){
		return ($this->qrticketsDAO->insertIntoParkingTable($userID,$dateOfCreation,$ticketID,$initialExpiryTime));
	}
	// Method to retrieve current parking ticket price
	public function getCurrentParkingPrice(){
		return($this->qrticketsDAO->getCurrentParkingPrice());
	}
	// Method to update the current parking ticket price
	public function updateParkingPrice($price){
		return($this->qrticketsDAO->updateParkingPrice($price));
	}
	// Method to retrieve the parking ticket expiry time which is intended to change
	public function getCurrentExpiryTimeToUpdate($ponumber){
		return($this->qrticketsDAO->getCurrentExpiryTime($ponumber));
	}
	// Method to update the expiry time of a parking ticket
	public function updateParkingExpiryTime($newExpiry,$ponumber,$currentTime){
		return($this->qrticketsDAO->updateParkingTicket($newExpiry,$ponumber,$currentTime));
	}
	// Method to insert generated qr information to the qr ticket table
	public function insertIntoQRTable($qrType,$stampID){
		return ($this->qrticketsDAO->insertIntoQRTable($qrType,$stampID));
	}
	// get Current active ticket expiry time - Used by customer to see how long they have left.
	public function getCurrentCParkExpiryTime(){
		$uid = $_SESSION['user_id'];
		$ponumber = $this->customersDAO->getPONumberLoggedIn($uid);
		return($this->qrticketsDAO->getCurrentCParkExpiryTime($ponumber));
	}
	// Method to delete a particular event by the event ID.
	public function deleteEvent($eid){
		$this->qrticketsDAO->deleteEvent($eid);
	}


	/*
	
		Methods For When a STAMP is Scanned!
	
	*/

	// Method to insert scanned data to database table along with its validity
	public function insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity){
		$this->qrticketsDAO->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);
	}
	// Method to check if a stamp is active
	public function isStampActive($ticketID){
		return($this->validationFactory->isStampActive($ticketID));
	}
	// Method to check if a stamp has been scanned twice by the same person, if so dont accept scanned data.
 	public function didSecondEmployeeScan($ticketID){
 		$uid = $_SESSION['user_id'];
 		$empNo = $this->employeesDAO->getEmpNumberLoggedIn($uid);
		return($this->validationFactory->didSecondEmployeeScan($empNo,$ticketID));
	}
	// Method to deactivate the stamp, when invalid.
	public function deactivateStampInStampsTable($ticketID){
		$this->qrticketsDAO->deactivateStampInStampsTable($ticketID);
	}

	public function updateTIDValidityApprove($ticketID){
		$this->qrticketsDAO->updateTIDValidityApprove($ticketID);
	}

	public function updateTIDValidityCheckDestination($ticketID){
		$this->qrticketsDAO->updateTIDValidityCheckDestination($ticketID);
	}

	public function hasTicketBeenScannedBefore($ticketID){
		return($this->qrticketsDAO->hasTicketBeenScanned($ticketID));
	}

	public function updateScanOnDepart($ticketID){
		$uid = $_SESSION['user_id'];
		$empNo = $this->employeesDAO->getEmpNumberLoggedIn($uid);
		$this->qrticketsDAO->updateScanOnDepart($ticketID,$empNo);
	}
	public function updateScanOnArr($ticketID){
		$this->qrticketsDAO->updateScanOnDepart($ticketID);
	}
	// UNFINISHED METHOD - to check is expiry time been reached
	public function isStampExpiryTimeValid($ticketID){
		return true;
	}

	/*
	
		Methods For When CPARK is scanned!
	
	*/
	// method to check is parking ticket active
	public function isCParkActive($ticketID){
		return($this->validationFactory->isCParkActive($ticketID));
	}
	// Method to check has parking ticket been scanned before.
	public function hasCPTicketBeenScanned($ticketID){
		return($this->validationFactory->hasCPTicketBeenScanned($ticketID));
	}
	// Method to see if any payment has been made on this ticket.
	public function hasCParkPaymentBeenMade($ticketID){
		return($this->qrticketsDAO->hasCParkPaymentBeenMade($ticketID));
	}
	// UNFINISHED - Method to check if expiry time of ticket has been reached
	/*public function hasCParkExpiryTimeBeenReached($ticketID){
		return($this->validationFactory->hasCParkExpiryTimeBeenReached($ticketID));
	}*/

	// Method to check if a fine has been issued to this ticket already.
	public function hasFineBeenIssued($ticketID){
		return($this->qrticketsDAO->hasFineBeenIssued($ticketID));
	}
	// Method to deactivate ticket after invalidity
	public function deactivateCParkTicketInPTTable($ticketID){
		$this->qrticketsDAO->deactivateCParkTicketInPTTable($ticketID);
	}
	/**
		The following 3 methods update the validity setting of the data which has been scanned into the system.

		These should be compressed into one function w/ 2 parameters instead of one.
	*/
	public function updateTIDValidityExpired($ticketID){
		$this->qrticketsDAO->updateTIDValidityExpired($ticketID);
	}
	public function updateTIDValidityValid($ticketID){
		$this->qrticketsDAO->updateTIDValidityValid($ticketID);
	}
	public function updateTIDValidityInactive($ticketID){
		$this->qrticketsDAO->updateTIDValidityInactive($ticketID);
	}
	// Method to update data in parking ticket table, changing scanned data.
	public function updateScannedDataInPTTable($ticketID){
		$uid = $_SESSION['user_id'];
		$empNo = $this->employeesDAO->getEmpNumberLoggedIn($uid);
		$this->qrticketsDAO->updateScannedDataInPTTable($ticketID,$empNo);
	}

	// Method to check if payment has been made
	public function hasValidPaymentBeenMade($ticketID){
		return($this->qrticketsDAO->hasValidPaymentBeenMade($ticketID));
	}
	// Method to check if a parkingticket is active
	public function checkForActiveTicket($ponumber){
		return($this->qrticketsDAO->getParkingTicketForUser($ponumber));
	}
	// Method to deactivate a parking ticket once invalid.
	public function deactivateExistingParkingTicket($ponumber){
		return($this->qrticketsDAO->deactivateExistingParkingTickets($ponumber));
	}

	/*
	
		Methods For Setting and Scanning Event / Invites.
		
	*/

	// Method to activate activate so ticket may be scanned into the system.
	public function updateEventActivity($eventID){
		$this->qrticketsDAO->updateEventActivity($eventID);
	}
	// method to set event id - this activates it.
	public function setEventID($eventID){
		$this->authenticationFactory->setEventID($eventID);
	}
	// Method to retrieve event id .
	public function getEventID(){
		if(isset($_SESSION['eventID']))	return($_SESSION['eventID']);
		else return false;
	}
	// Method to check update the validity of the ticket to display new information on scanned data.
	public function updateTIDValidityPrescanned($ticketID){
		$this->qrticketsDAO->updateTIDValidityPrescanned($ticketID);
	}
	// Method to check if this ticket has already been scanned.
	public function hasInviteAlreadyBeenScanned($ticketID){
		$this->qrticketsDAO->hasInviteAlreadyBeenScanned($ticketID);
	}
	// Method to update attended status for an event
	public function updateAttendedStatus($ticketID){
		$this->qrticketsDAO->updateAttendedStatus($ticketID);
	}
	// Method to increment the number of attendees to aparticular event.
	public function incrementAttendeesField($eventID){
		$this->qrticketsDAO->incrementAttendeesField($eventID);
	}









	/*
	*	System Log in Methods
	*	Error Message Assignments
	*	System Status
	*	etc.
	*
	*/
	
	public function loginUser($userId, $username,$isUserEmploy) {
		$this->authenticationFactory->loginUser ( $userId, $username,$isUserEmploy);
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