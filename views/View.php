<?php
class View {
	private $model;
	private $controller;
	
	public function __construct($controller, $model) {
		/*
			Here both the controller and model are assigned to usable variables within the view.
		*/
		$this->controller = $controller;
		$this->model = $model;
	}
	/*
		The following function is called in the index.php. 

		It controlls the output onto the screen
	*/ 
	public function output() {
		// set variables up from the model (for the template)
		$appName = $this->model->appName;

		$introMessage = $this->model->introMessage;
		$newUserErrorMessage = $this->model->newUserErrorMessage;
	
		$username = "";
		$ponumber = "";
	

		$cusloginBox = file_get_contents ( "./templates/cus_login_form.php", FILE_USE_INCLUDE_PATH );
		$registrationForm = file_get_contents('./templates/insert_new_user_form.php',FILE_USE_INCLUDE_PATH);
		$registrationEmployeeForm = file_get_contents('./templates/insertNewEmployee_form.php',FILE_USE_INCLUDE_PATH);
		$searchCusForm = file_get_contents('./templates/search_form.php');
		$issueReport = file_get_contents('./templates/reportIssue.php');
		$userChangePassword = file_get_contents('./templates/changePasswordForm.php');
		$topUpParkingTicketForm = file_get_contents('./templates/topUpParkingTicket_form.php');
		$updateCustomerForm = file_get_contents('./templates/update_user_form.php');
		$changePinForm = file_get_contents('./templates/changePinForm.php');
		$loginBar = file_get_contents('./templates/loginaBar.php');
		$emailsForm = file_get_contents('./templates/inviteEmails_form.php');
		$stampForm = file_get_contents('./templates/postalStampForm.php');
		$parkingForm = file_get_contents('./templates/parkingTicketForm.php');
		$download = file_get_contents('./phpqrcode/download_header.php');
		$changeCPPrice = file_get_contents('./templates/updateParkingPrice_form.php');
		$contactByNotification = file_get_contents('./templates/contactCustomerByNotification.php');
		$setEventIDForm = file_get_contents('./templates/setEventID_form.php');
		


		$authenticationErrorMessage = "";
		$leftBox = "";
		$empLeftBox= "";
		$adLeftBox="";
		$rightBox = "";
		$middleBox = "";
		$introTop="";
		$confirmationMessage = "";
		$displayTables = "";
		$tableChoice = null;
		$var_loggedIn = $this->model->loginStatusString;
		$var = "";

		
		if ($var_loggedIn != null) {
				
				$username = $this->model->authenticationFactory->getUsernameLoggedIn();
				$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
				$empnumber = $this->model->authenticationFactory->getEmpNumberLoggedIn();
				$loginBox = "<a href='index.php?action=logout'>" . $this->model->loginStatusString . "</a>";
				
				$var = $this->model->authenticationFactory->isUserEmployee();
				
				if( $var != null){
					if($this->model->isUserLoggedInAdmin()){
						//$introTop = $username . " : " . $empnumber;
						$adLink;

						if(! empty($_GET['adButton'])) $adLink = $_GET['adButton'];
						else $adLink ="";

						if($adLink == 'liopenScanner'){

							// either open scanner on view
							// or display

						}
						else if($adLink == 'lireportIssue'){
							$adLeftBox = $employee_issueReport;
						}
						else if($adLink == 'liPassChange'){
							$adLeftBox = $changePinForm;
						}
						else if($adLink == 'liAddNewEmployee'){
							$adLeftBox = $registrationEmployeeForm;
						}
						else if($adLink == 'liChangeCPPrice'){
							$adLeftBox = $changeCPPrice;
						}
						else if($adLink == ''){

						}

						
					}else


						$empLink;
						if (! empty($_GET['empButton'])) $empLink = $_GET['empButton'];
						else $empLink = "";


						if($empLink=='contactByNotification'){
							$empLeftBox = $contactByNotification;
						}
						else if($empLink == 'liSetEventID'){
							$empLeftBox = $setEventIDForm;
						}
						else if($empLink == 'liPassChange'){
							$empLeftBox = $changePinForm;
						}
						else if($empLink == 'liSearchCustomers'){
							$empLeftBox = $searchCusForm;
						}
						
				}
				else
			

					$introTop = $username . " : " . $ponumber;

					$link;
					$link2;
					
					if (! empty($_GET['button'])) $link = $_GET['button'];
					else $link = "";

					

					if(! isset($_POST['submitStamp']) && ! isset($_POST['submitCPark'])){
						if($link == 'liReport'){
							$leftBox = $issueReport;
						}
						else if($link=='liCreateEvent'){
							$leftBox = $emailsForm;
						}
						else if($link == 'liCreateStamp'){
							$leftBox = $stampForm;
						}
						else if($link == 'liCreateParkTicket'){
							$leftBox = $parkingForm;
						}
						else if($link =='liPassChange'){
							$leftBox = $userChangePassword;
						}
						else if($link == 'topUpParkingTicket'){
							$leftBox = $topUpParkingTicketForm;
						}
						else if($link == 'liEditInfo'){
							$leftBox = $updateCustomerForm;
						}
						else{
							$leftBox = "" ;
						}
					}
					else
					{
						// TODO
						// Check if insert into appropriate table has been successfull
						
						$leftBox = $download; 
					}
				
				if($var !=null && $this->model->isUserLoggedInAdmin()){
					$introTop = $username . " : " . $empnumber;
					include_once'./templates/template_index_admin.php';
				}
				else if($var !=null && !$this->model->isUserLoggedInAdmin()){
					$introTop = $username . " : " . $empnumber;
					include_once'./templates/template_index_employee.php';
				}
				else {
					$introTop = $username . " : " . $ponumber;
					include_once'./templates/template_index.php';
				}
		}
		// The  Admin view has be completely taken out here
		else {


			$loginBox  = $loginBar;

			$authenticationErrorMessage = "";
			
			if ($this->model->hasAuthenticationFailed)
				$authenticationErrorMessage = $this->model->authenticationErrorMessage;
				

			if(! empty($_GET['buttonLogin'])) $link = $_GET['buttonLogin'];
			else $link = "";


			if($link == 'registerbutton' ){
				$middleBox = $registrationForm ; 
			}
			else{
				$middleBox = $cusloginBox ; 
			}
			
			//$rightBox = "<img src='./images/cus1.jpe' alt='Customer'>"; 
			$leftBox = "<img src='./images/envelope.png' alt='envelope'>";

		

			include_once ("templates/template_index_login.php");
			
			if (! isset ( $this->model->hasRegistrationFailed )) {
				$leftBox = $registrationForm;
			} else if ($this->model->hasRegistrationFailed) {
				$leftBox = $newUserErrorMessage . $registrationForm;
			} else if ($this->model->hasRegistrationFailed == false) {
				$confirmationMessage = "<div class='alert alert-success'>" . $this->model->signUpConfirmation . "</div>";
				$leftBox = $confirmationMessage;
			}
			
		}
		
	}
}
?>