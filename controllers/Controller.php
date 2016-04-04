<?php
 
	class Controller {
		private $model;
		/*
		Switch Statement declared to choose which action is been used by the user
		*/
		public function __construct($model, $action = null, $parameters) {
			$this->model = $model;
			switch ($action) {
				case "stripePayment":
					$this->stripePayment($parameters);
					break;
				case "deleteEvent":
					$this->deleteEvent($parameters);
					break;
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
					$this->createParkingTicket($parameters);
					break;
				case "deleteCustomer" : 
					$this->deleteCustomer($parameters);
					break;
				case "insertNewEmployee" :
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
				case "makeAdmin":
					$this->makeAdmin($parameters);
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
				case "updateParkingPrice":
					$this->updateParkingPrice($parameters);
					break;
				case "searchCustomers":
					$this->searchCustomers($parameters);
					break;
				default :
					break;
			}
			
			//Call the prepareIntroMessage() method from model after the switch statement is cleared
			$this->model->prepareIntroMessage ();
			//Calling the updateHeader  method, which calls methods from the model to check the login status of the user, and to update that status if needed

			$e__ID = "";
			if(!empty($_GET['evId'])) $e__ID =$_GET['evId'];
			else $e__ID = "";

			$this->updateHeader ();
			$this->model->getAllCustomers();
			$this->model->getAllCustomerIssues();
			$this->model->getAllEmployeeIssues();
			$this->model->getAllEmployees();
			$this->model->getUserDetails();
			$this->model->getEmployeeDetails();
			//$this->model->searchCustomers($parameters['searchValue']);
			$this->model->getAllStamps();
			$this->model->getAllEvents();
			$this->model->getAllParkingTickets();
			$this->model->getAllEventsForUser();
			$this->model->getAllDetailsForEvent($e__ID);
			$this->model->getScannedDataForEmployee(); 
			
		}

		function stripePayment($parameters){
			\Stripe\Stripe::setApiKey("sk_test_8mEEBKrOnvUrMtDpQGBUBnri ");

			// Get the credit card details submitted by the form
			$token = $_POST['stripeToken'];


			// Create a Customer
			$customer = \Stripe\Customer::create(array(
			  "source" => $token,
			  "description" => "Example customer")
			);

			// Charge the Customer instead of the card
			\Stripe\Charge::create(array(
			  "amount" => 1000, // amount in cents, again
			  "currency" => "eur",
			  "customer" => $customer->id)
			);

			// YOUR CODE: Save the customer ID and other info in a database for later!

			// YOUR CODE: When it's time to charge the customer again, retrieve the customer ID!

			\Stripe\Charge::create(array(
			  "amount"   => 1500, // €15.00 this time
			  "currency" => "eur",
			  "customer" => $customerId // Previously stored, then retrieved
			  ));

		
		}

		function updateParkingPrice($parameters){
			$price = $parameters['parkingPrice'];

			if(! empty($price))
				$this->model->updateParkingPrice($price);
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

		function searchCustomers($parameters){
			$search = $parameters['searchValue'];
			$this->model->searchCustomers($search);
		}
		
		
		function deleteCustomer($parameters){
			$custID = $parameters['cus_id'];
			if(! empty($custId))
				$this->model->deleteCustomer;
		}

		function deleteEmployee($parameters){
			$eid = $parameters['eid'];
			if(!empty($eid))
				$this->model->deleteEmployee($eid);
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
			$inviteType=$parameters["inviteType"];
			$eventID=$this->model->validationFactory->eventIDGenerator();
			$dateOfCreation = date('Y/m/d H:i:s');
			$ticketID = "";


			$message = "You are invited to my event!";
			$subject = "Event invite!";
			$qrType = "EVENT";
			$inviteNames = $parameters['names'];
			$inviteEmail = $parameters['emails'];
			$noOfInvites = 0;

			foreach($inviteNames as $index)	
				$noOfInvites++;
 			
			//if(strtotime($eventDate>$dateOfCreation))
				if($this->model->createEvent($eventCreator,$eventName,$eventDesc,$eventDate,$eventLoc,$noOfInvites,$inviteType,$eventID,$dateOfCreation))
					foreach($inviteNames as $index=>$name){
						$ticketID = $this->model->validationFactory->inviteIDGenerator($eventID);
						$this->model->sendInvites($name,$inviteEmail[$index],$eventID,$ticketID);
						include_once './callQRGenerator.php';
						include_once './mailgun-php-1.7.1/mailgun-php/sendEmail.php';
					}

		}

		function deleteEvent($parameters){
			$eid = $parameters['ev_ID'];
			if(! empty($eid))
				$this->model->deleteEvent($eid);
		}

		function createParkingTicket($parameters){

			if(! empty($parameters['expiryTime'])) $initialExpiryTime = $parameters['expiryTime'];
			else $initialExpiryTime=date('Y/m/d');
			
			
			$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
			$dateOfCreation = date('Y/m/d h:i:s');
			$ticketID = $this->model->validationFactory->qrcodeIDGenerator();
			$qrType = "CPARK";
			$eventID = null;
			$password = $parameters['fPassword'];
			$hashedPassword = $this->model->authenticationFactory->getHashValue($password);
			$dbpassword = $this->model->authenticationFactory->passwordOfUserLoggedIn();

			if($hashedPassword == $dbpassword)
				if($this->model->checkForActiveTicket($ponumber)) // Only one active car parking ticket permitted per user.	
					$this->model->deactivateExistingParkingTicket($ponumber);
				if($this->model->insertIntoQRTable($qrType,$ticketID))
					if($this->model->createParkingTicket($ponumber,$dateOfCreation,$ticketID,$initialExpiryTime))
						include_once'./callQRGenerator.php';
						//Deduct Appropriate Amount
					
		}

		function updateParkingTicket($parameters){
			$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
			$option = $parameters['topUpUsing'];
			$amount = 100*$parameters['amount'];
			$duration = $parameters['duration'];
			$currentTime = date('Y-m-d H-i-s');
			$currentExpiry = "";
			$currentParkingPrice = $this->model->getCurrentParkingPrice();
			$minutes = "";
			$newExpiry="";

			if(! empty($amount) && $option == 1) $cost = $amount;
			else $cost = "";

			if($this->model->checkForActiveTicket($ponumber))
				$currentExpiry = $this->model->getCurrentExpiryTimeToUpdate($ponumber);
			


			if($option==2){
				
				$var = round($amount/$currentParkingPrice,2);

				if(is_float($var)){
					$str_arr = explode('.',$var);
					$addHour = $str_arr[0];

					if(! empty($str_arr[1])) $aftDec = $str_arr[1];
					else $aftDec = null;
					
					if(empty($aftDec)) $minutes = 0;
					else $minutes = round($aftDec*.6);
				}
				else 
					$addHour = $var;
				$newExpiry = date('Y-m-d H:i:s',strtotime($currentExpiry) + (60*60*$addHour)+60*$minutes); 

			}
			else if($option == 1){
				$cost = $duration*$currentParkingPrice;
				$addedTime = $duration*60*60;
				$newExpiry = date('Y-m-d H:i:s',strtotime($currentExpiry) +$addedTime); 
			}
			else 
				$cost = null;
				$newExpiry = $currentExpiry;

			/**
				TODO

				****
				BEFORE UPDATE ENSURE THAT MONEY HAS BEEN PAID, BUT ALSO ENSURE BEFORE MONEY IS PAID THAT THE DB IS UPDATED
			*/

			if(! empty($newExpiry))
				$this->model->updateParkingExpiryTime($newExpiry,$ponumber,$currentTime);

			
		}

		function createStamp($parameters){

			$destination = $parameters["destination"];
			$weight = $parameters["weight"];
			$type = $parameters["type"];
			$qrType = "STAMP";
			$eventID = null;
			$ticketID = $this->model->validationFactory->qrcodeIDGenerator();
			$dateCreated = date('Y/m/d h:i:s');
			$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
			$password = $parameters["fPassword"];
			$hashedPassword = $this->model->authenticationFactory->getHashValue($password);

			$dbpassword = $this->model->authenticationFactory->passwordOfUserLoggedIn();
						
			if($hashedPassword == $dbpassword)
				if($this->model->insertIntoQRTable($qrType,$ticketID))
					if($this->model->createStamp($destination,$weight,$type,$ticketID,$ponumber))
						include_once './callQRGenerator.php';

							
		}

		function makeAdmin($parameters){

			$eid = $parameters['eid'];
			if(!empty($eid))
				$this->model->makeAdmin($eid);
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
									if ($this->model->insertNewCustomer ( $firstName,$secondName,$mobile,$address,$email, $hashedPassword,$date_joined,$ponumber )) {
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
			$mobile = $parameters["fMobile"];
			$address = $parameters["fAddr"];
			$email = $parameters ["fEmail"];
			$empPin = $parameters ["fPassword"];
			$empPinConf = $parameters["fPassConf"];
			$date_joined = date("Y/m/d h:i:sa");
			$companyID = $parameters['fCompanyName'];
			$service = $parameters['fCompanyService'];
			//$companyID = $this->model->validationFactory->getCompanyIDByName($companyName);
			$empNum = $this->model->validationFactory->empNumGenerator();
			
			//All fields must be filled
			if (! empty ( $firstName ) && ! empty ( $secondName ) && ! empty ( $email ) && ! empty ( $mobile ) && ! empty ( $address ) && ! empty ( $empPin ) && ! empty($date_joined) && ! empty($empNum) && ! empty($service) ){
				/*
				In this if statement , the controller checks various validity methods from the model. 
				This is mainly to ensure that the new  email that the new user has entered does not match an existing user and that character lenght and casings are adequate
				*/
				if($empPin == $empPinConf){
					if(! empty($companyID)){
						if ($this->model->validationFactory->isLengthStringValid( $firstName, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->model->validationFactory->isLengthStringValid ($secondName,NEW_USER_FORM_MAX_USERNAME_LENGTH) && $this->model->validationFactory->isEmailValid ( $email ) && $this->model->validationFactory->isMobileValid( $mobile , MAX_LENGTH_FOR_MOBILE )) {
							//if (! $this->model->authenticationFactory->isAdminEmailExisting ( $email )) {
							// the hashed password is saved in a variable and along with the new username .....
								$hashedPin = $this->model->authenticationFactory->getHashValue ( $empPin );
								//...... is inserted to the database
								// the hasRegistrationFailed methosd is assigned false so will not take affect 
								//the user is notified of the completed insertion
								if ($this->model->insertNewEmployee( $firstName,$secondName,$dob,$mobile,$address,$email, $hashedPin,$date_joined,$empNum,$companyID,$service)) {
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
						
						if($databaseHashedPin == $userHashedPin){

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