<?php
 
	class Controller {
		private $model;
		/*
		Switch Statement declared to choose which action is been used by the user
		*/
		public function __construct($model, $action = null, $parameters) {
			$this->model = $model;
			switch ($action) {
				case "insertNewUser" :
					$this->insertNewCustomer ( $parameters );
					break;
				case "sendInvites" :
					$this->createEvent($parameters); 
					break;
				case "createPostStamp":
					$this->createStamp($parameters);
					break;
				case "createCarTicket":
					$this->createParkingTicket();
					break;
				case "deleteCustomer" : 
					$this->deleteCustomer($parameters);
					break;
				case "insertNewAdmin" :
					$this->insertNewEmployee($parameters);
					break;
				case "reportIssue" :
					$this->reportIssue($parameters);
					break;
				case "loginUser" :
					$this->loginUser ( $parameters );
					break;
				case "deleteEmployee" : 
					$this->deleteEmployee($parameters);
					break;
				case "changePasswordForm":
					$this->changePassword($parameters);
					break;
				case "changePinForm":
					$this->changePin($parameters);
					break;
				case "logout" :
					$this->logoutUser ();
					break;
				case "updateUserForm" : 
					$this->updateUserForm($parameters);
					break;
				case "updateParkingTicket" : 
					$this->updateParkingTicket($parameters);
					break;
				case "insertNewRecord":
					$this->insertNewRecord($parameters);
					break;
				case "updateRecord":
					$this->updateRecord($parameters);
					break;
				case "viewUsers":
					$this->getAllUsers();
					break;
				case "viewOrders":
					$this->getAllOrders();
					break;	
				case "viewIssues":
					$this->getAllIssues();
					break;
				case "viewEmployees":
					$this->getAllEmployees();
					break;			
				case "makeOrder":
					$this->makeOrder($parameters);
					break;
				case "deleteRecord":
					$this->deleteRecord($parameters);
					break;
				case "search":
					$this->search($parameters);
					break;
				default :
					break;
			}
			
			//Call the prepareIntroMessage() method from model after the switch statement is cleared
			$this->model->prepareIntroMessage ();
			//Calling the updateHeader  method, which calls methods from the model to check the login status of the user, and to update that status if needed
			$this->updateHeader ();
			$this->model->getAllUsers();
			$this->model->getAllIssues();
			$this->model->getAllEmployees();
			$this->model->getUserDetails();
			$this->model->getEmployeeDetails();
			#$this->model->search($parameters);
		}
		


		function reportIssue($parameters){
			$subject = $parameters['issueSubject']; 
			$content = $parameters['issueContent'];
			$userId = $this->model->authenticationFactory->getIDLoggedIn();
			$userPO = $this->model->authenticationFactory->getPONumberLoggedIn();
			$date = date('Y/m/d');
			$username = $this->model->authenticationFactory->getUsernameLoggedIn();

			$this->model->reportIssue($subject,$content,$userId,$userPO,$date,$username);
		}


		function updateUserForm(){
			$userId = $this->model->authenticationFactory->getIDLoggedIn();
			$this->model->updateUserForm($userId);
		}

		function search($parameters){
			$search = $parameters['search'];
			$this->model->search($search);
		}
		
		function deleteRecord($parameters){
			$mID = $parameters ['movie'];
			$this->model->deleteRecord($mID);
		
		}
		
		function deleteCustomer($parameters){
			$email = $parameters['fEmail'];
			$ponumber = $parameters['fponumber'];

			$POEmail = $this->model->compareEmailToPO ($ponumber);

//$a = array_map('strval', $a);
			if( $email==$POEmail) {
				$this->model->deleteUser($email);
			}
			else{
				$this->model->setUpNewUserError ( NEW_USER_FORM_ERRORS_CUS_DELETEMISMATCH );
			}
		}

		function deleteEmployee($parameters){
			$empName = $parameters['empName'];
			$empNum = $parameters['empNum'];
		}
		/**
		 * Validate the input parameters, and if successful, and user does not exist,
		 * insert the new user in the database
		 *
		 * @param : $parameters
		 *        	- array containing the parameters to be validated
		 */
		function changePassword($parameters){

			$curPass = $parameters["currentPass"];
			$newPass = $parameters["newPassword"];
			$newPassConf = $parameters["confPassword"];

			if($this->model->authenticationFactory->passwordVerificationOfUserLoggedIn($curPass)){
				if($newPass == $newPassConf){

					$hashNewPass = $this->model->authenticationFactory->getHashValue($newPass);

					$userId = $this->model->authenticationFactory->getIDLoggedIn();

					$this->model->changePassword($hashNewPass,$userId);

				}
			}
		}

		function changePin($parameters){

			$curPin = $parameters["currentPin"];
			$newPin = $parameters["newPin"];
			$newPinConf = $parameters["confPin"];

			if($this->model->authenticationFactory->pinVerificationOfUserLoggedIn($curPin)){
				if($newPin == $newPinConf){

					$hashNewPin = $this->model->authenticationFactory->getHashValue($newPin);

					$userId = $this->model->authenticationFactory->getIDLoggedIn();

					$this->model->changePin($hashNewPin,$userId);

				}
			}
		}


		function createEvent($parameters){
			$eventCreator= $this->model->authenticationFactory->getPONumberLoggedIn();
			$eventName= $parameters["nameOfEvent"];
			$eventDesc= $parameters["descOfEvent"];
			$eventDate= $parameters["dateOfEvent"];
			$eventLoc=$parameters["eventLocation"];
			$noOfInvites="";
			$inviteType=$parameters["inviteType"];
			$eventID=//generate random value (not already in database)
			$dateOfCreation = date('Y/m/d');

			$message = "You are invited to my event!";
			$subject = "Event invite!";
			$email = $parameters['emails'];
			$qrType = "EVENT";

			//check that the variables are not empty

			$this->model->createEvent($eventCreator,$eventName,$eventDesc,$eventDate,$eventLoc,$noOfInvites,$inviteType,$eventID,$dateOfCreation);
		}

		function createParkingTicket(){
			$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
			$dateOfCreation = date('Y/m/d h:i:s');
			$ticketID = $this->model->validationFactory->qrcodeIDGenerator();
			$qrType = "CPARK";
			$password = $parameters['fPassword'];
			$hashedPassword = $this->model->authenticationFactory->getHashValue($password);
			$dbpassword = $this->model->authenticationFactory->passwordOfUserLoggedIn();
				
			if($hashedPassword == $dbpassword)
				if($this->model->insertIntoQRTable($qrType,$ticketID))
					if($this->model->createParkingTicket($ponumber,$dateOfCreation,$ticketID))
						include_once'./callQRGenerator.php';
				
		}

		function updateParkingTicket($parameters){
			$option = $parameters['topUpUsing'];
			$amount = $parameters['amount'];
			$duration = $parameters['duration'];

			/**
				WORKING OFF THE ASSUMPTION 1EURO = 1 HOUR;
			*/

			if(! empty($option)){
				if($option == "1"){ // TOP UP BY DURATION
					//
				}
				else if($option == "2"){ // TOP UP BY AMOUNT
					//
				}else{
					//
				}

			}
		}

		function createStamp($parameters){

			$destination = $parameters["destination"];
			$weight = $parameters["weight"];
			$type = $parameters["type"];
			$qrType = "STAMP";
			$stampID = $this->model->validationFactory->qrcodeIDGenerator();
			$dateCreated = date('Y/m/d h:i:s');
			$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
			$password = $parameters["fPassword"];
			$hashedPassword = $this->model->authenticationFactory->getHashValue($password);

			$dbpassword = $this->model->authenticationFactory->passwordOfUserLoggedIn();
						
			if($hashedPassword == $dbpassword)
				if($this->model->insertIntoQRTable($qrType,$stampID))
					if($this->model->createStamp($destination,$weight,$type,$stampID,$ponumber))
						include_once './callQRGenerator.php';

							
		}

		function makeOrder($parameters){

			$envs = $parameters["orderEnvs"];
			$stickers = $parameters["orderStickers"];
			$userPassword = $parameters["fPassword"];
			$cost = ($envs*7)+($stickers*2);
			$username = $this->model->authenticationFactory->getUsernameLoggedIn();
			$date_ordered = date("Y/m/d");
			$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();

			if($this->model->authenticationFactory->passwordVerificationOfUserLoggedIn($userPassword)){
				$this->model->makeOrder($username,$ponumber,$envs,$stickers,$date_ordered,$cost);}
			else
				return (false);

		}


		/**
	
			THE FOLLOWING ARE INSERT USERS AND LOGIN FIELDS.
	
		*/

		function insertNewCustomer($parameters) {
			$firstName = $parameters["fFirstname"];
			$secondName = $parameters["fSurname"];
			$dob = $parameters["fDOB"];
			$mobile = $parameters["fMobile"];
			$address = $parameters["fAddr"];
			$email = $parameters ["fEmail"];
			$password = $parameters ["fPassword"];
			$passConf = $parameters ["fPassConf"];
			$date_joined = date("Y/m/d");
			$ponumber = $this->model->validationFactory->poNumGenerator();
			$ac_amount = 5.00;
			
			//All fields must be filled
			if (! empty ( $firstName ) && ! empty ( $secondName ) && ! empty ( $email ) && ! empty ( $mobile ) && ! empty ( $address ) && ! empty ( $password ) && ! empty($date_joined) && ! empty($ponumber)) {
				/*
				In this if statement , the controller checks various validity methods from the model. 
				This is mainly to ensure that the new  email that the new user has entered does not match an existing user and that character lenght and casings are adequate
				*/
				//if($this->model->validationFactory->isUserAgeValid($dob,16)){
					if(strcmp($password , $passConf) == 0 ){
							if ($this->model->validationFactory->isLengthStringValid( $firstName, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->model->validationFactory->isLengthStringValid ($secondName,NEW_USER_FORM_MAX_USERNAME_LENGTH) && $this->model->validationFactory->isLengthStringValid ( $password, NEW_USER_FORM_MAX_PASSWORD_LENGTH ) && $this->model->validationFactory->isEmailValid ( $email ) && $this->model->validationFactory->isMobileValid( $mobile , MAX_LENGTH_FOR_MOBILE )) {
								if (! $this->model->authenticationFactory->isUserExisting ( $email )) {
								// the hashed password is saved in a variable and along with the new username .....
									$hashedPassword = $this->model->authenticationFactory->getHashValue ( $password );
									if ($this->model->insertNewCustomer ( $firstName,$secondName,$mobile,$address,$email, $hashedPassword,$date_joined,$ponumber,$ac_amount )) {
										$this->model->hasRegistrationFailed = false;
										$this->model->setConfirmationMessage();
										/*
											This script is included to send SMS message to new user, using the mobile number they provided.
										*/
										 //include_once './sendSMS.php';
										return (true);
										
									}
									
									/*
									The model is holding all the error messages, therefore should any of the aspects 
									fail during user insertion the user will be notified of where and why they failed
									*/
								} else
									$this->model->setUpNewUserError ( NEW_USER_FORM_EXISTING_ERROR_STR );
							} else
								$this->model->setUpNewUserError ( NEW_USER_FORM_ERRORS_STR );
					}
					else
						$this->model->setUpNewUserError ( NEW_USER_FORM_ERRORS_PWMISMATCH );
				/*} else
					$this->model->setUpNewUserError(NEW_USER_FORM_ERRORS_COMPULSORY_STR);*/
			} else
				$this->model->setUpNewUserError ( NEW_USER_FORM_ERRORS_COMPULSORY_STR );
			
//			$this->model->hasRegistrationFailed = true;
//			$this->model->updateLoginErrorMessage ();
//			return (false);
		}

		function insertNewEmployee($parameters) {
			$firstName = $parameters["fFirstname"];
			$secondName = $parameters["fSurname"];
			$dob = $parameters["fDOB"];
			$is_admin = $parameters["fIs_Admin"];
			$mobile = $parameters["fMobile"];
			$address = $parameters["fAddr"];
			$email = $parameters ["fEmail"];
			$empPin = $parameters ["fPin"];
			$empPinConf = $parameters["fPinConf"];
			$date_joined = date("Y/m/d h:i:sa");
			$empNum = $this->model->validationFactory->empNumGenerator();
			
			//All fields must be filled
			if (! empty ( $firstName ) && ! empty ( $secondName ) && ! empty ( $email ) && ! empty ( $mobile ) && ! empty ( $address ) && ! empty ( $empPin ) && ! empty($date_joined) && ! empty($empNum)) {
				/*
				In this if statement , the controller checks various validity methods from the model. 
				This is mainly to ensure that the new  email that the new user has entered does not match an existing user and that character lenght and casings are adequate
				*/
				if($empPin == $empPinConf){
					if($this->model->validationFactory->isUserAgeValid($dob,18)){
						if ($this->model->validationFactory->isLengthStringValid( $firstName, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->model->validationFactory->isLengthStringValid ($secondName,NEW_USER_FORM_MAX_USERNAME_LENGTH) && $this->model->validationFactory->isEmailValid ( $email ) && $this->model->validationFactory->isMobileValid( $mobile , MAX_LENGTH_FOR_MOBILE )) {
							//if (! $this->model->authenticationFactory->isAdminEmailExisting ( $email )) {
							// the hashed password is saved in a variable and along with the new username .....
								$hashedPin = $this->model->authenticationFactory->getHashValue ( $empPin );
								//...... is inserted to the database
								// the hasRegistrationFailed methosd is assigned false so will not take affect 
								//the user is notified of the completed insertion
								if ($this->model->insertNewEmployee ( $firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin,$date_joined,$empNum,$is_admin)) {
									$this->model->hasRegistrationFailed = false;
									$this->model->setConfirmationMessage();
									return (true);
								}
								
								/*
								The model is holding all the error messages, therefore should any of the aspects 
								fail during user insertion the user will be notified of where and why they failed
								*/
							//} else
							//	$this->model->setUpNewUserError ( NEW_USER_FORM_EXISTING_ERROR_STR );
						} else
							$this->model->setUpNewUserError ( NEW_USER_FORM_ERRORS_STR );
					}else
						$this->model->setUpNewUserError( NEW_USER_FORM_EXISTING_ERROR_STR);
				}else 
					$this->model->setUpNewUserError( NEW_USER_FORM_MAX_USERNAME_LENGTH);
			} else
				$this->model->setUpNewUserError ( NEW_USER_FORM_ERRORS_COMPULSORY_STR );
			
//			$this->model->hasRegistrationFailed = true;
//			$this->model->updateLoginErrorMessage ();
//			return (false);
		}		
		
		/**
		 * Validate the input parameters, and if successful, authenticate the user.
		 * If authentication process is ok, login the user.
		 *
		 * @param : $parameters
		 *        	- array containing the parameters to be validated. 
		 *        This is the $_REQUEST super global array.
		 */
		function loginUser($parameters) {
			$email = $parameters ["fEmail"];
			$password = $parameters ["fPassword"];
			// both the username and password need to provided in order for user login 
			if (! (empty ( $email ) && empty ( $password ))) {

				if((is_numeric($email)) && (is_numeric($password))){

					$isEmployee = true;

					if($this->model->validationFactory->isPinLengthValid($password, 6,4) && $this->model->validationFactory->isEmpNumLengthValid($email,6)){

						$databaseHashedPin = $this->model->getUserPinDigest($email);
						$userHashedPin = $this->model->authenticationFactory->getHashValue($password);
						
						if($databaseHashedPin == $password){

							$userId = $this->model->getAdminId ( $email );
							$username = $this->model->getAdminUserName( $userId );
							$this->model->loginUser ( $userId, $username, $isEmployee );
							$this->model->updateLoginStatus();
							$this->model->hasAuthenticationFailed = false;
							return;
						}
					}

				}else
				{
				// checks the the validaton factory to make to make sure that the user trying to log in has entered the sufficient amount of characters
					if ($this->model->validationFactory->isEmailValid ( $email ) && $this->model->validationFactory->isLengthStringValid ( $password, NEW_USER_FORM_MAX_PASSWORD_LENGTH )) {
						//here the  controller calls the getUserPasswordDigest from the model, which calls it from the usersDAO ..which queries the database for the hash passwords which matches the entered username
						$databaseHashedPassword = $this->model->getUserPasswordDigest ( $email );
						$isNotEmployee = null;
						//here the controller calls the getHashValue from the authenticationFactory  and stores the hash password value which teh user has just entered in.
						$userHashedPassword = $this->model->authenticationFactory->getHashValue ( $password );
						/*
						These 2 hash values  are then compared to check if correct credentials have been entered.
						Then get the userID from the model method which calls it from the usersDAO
						*/
						if ($databaseHashedPassword == $userHashedPassword) {
							$userId = $this->model->getUserId ( $email );
							$username = $this->model->getUserName( $userId );
							$this->model->loginUser ( $userId, $username,$isNotEmployee );
							$this->model->updateLoginStatus();
							$this->model->hasAuthenticationFailed = false;
							return;
						}
					}
				}
			}
			$this->model->updateLoginErrorMessage ();
			$this->model->hasAuthenticationFailed = true;
			return;
		}
		
		// method to call the logoutUser method from the model which calls it from the authenticationFactory
		function logoutUser() {
			$this->model->logoutUser ();
		}
		// method to check if the user is logged in and to update the login status  which calls it from the authenticationFactory
		function updateHeader() {
			if ($this->model->isUserLoggedIn ())
				$this->model->updateLoginStatus ();
		}
			
	
	}
?>