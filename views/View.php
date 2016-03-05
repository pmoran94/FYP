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
	public function output() {
		// set variables up from the model (for the template)
		$appName = $this->model->appName;

		$introMessage = $this->model->introMessage;
		$newUserErrorMessage = $this->model->newUserErrorMessage;
	
		$username = "";
		$ponumber = "";
	

		$cusloginBox = file_get_contents ( "./templates/cus_login_form.php", FILE_USE_INCLUDE_PATH );
		$registrationForm = file_get_contents('./templates/insert_new_user_form.php',FILE_USE_INCLUDE_PATH);
		$registrationAdminForm = file_get_contents('./templates/insert_new_admin_form.php',FILE_USE_INCLUDE_PATH);
		$updateRecordForm = file_get_contents('./templates/update_record_form.php');
		$newRecordForm = file_get_contents('./templates/insert_new_record.php');
		$customersTable = file_get_contents('./templates/view_users.php');
		$searchForm = file_get_contents('./templates/search_form.php');
		$registerButton = file_get_contents('./templates/registrationButton.php');
		$loggedInUserActions = file_get_contents('./templates/loggedInUserActions.php');
		$issueReport = file_get_contents('./templates/reportIssue.php');
		$employee_issueReport = file_get_contents('./templates/employee_reportIssue_form.php');
		$makeOrder = file_get_contents('./templates/makeOrder.php');
		$loggedInAdminActions = file_get_contents('./templates/loggedInAdminActions.php');
		$deleteEmployee = file_get_contents('./templates/delete_employee.php');
		$deleteCustomer = file_get_contents('./templates/deleteUser.php');
		$userChangePassword = file_get_contents('./templates/changePasswordForm.php');
		$topUpParkingTicketForm = file_get_contents('./templates/topUpParkingTicket_form.php');
		$updateCustomerForm = file_get_contents('./templates/update_user_form.php');
		$changePinForm = file_get_contents('./templates/changePinForm.php');
		$loginBar = file_get_contents('./templates/loginaBar.php');
		$emailsForm = file_get_contents('./templates/inviteEmails_form.php');
		$stampForm = file_get_contents('./templates/postalStampForm.php');
		$parkingForm = file_get_contents('./templates/parkingTicketForm.php');
		$download = file_get_contents('./download_header.php');


		$authenticationErrorMessage = "";
		$leftBox = "";
		$empLeftBox= "";
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
						$admLink;
						
					}else
						if (! empty($_GET['empButton'])) $empLink = $_GET['empButton'];
						else $empLink = "";

						if($empLink == 'liopenScanner'){

							// either open scanner on view
							// or display

						}
						else if($empLink == 'lireportIssue'){
							$empLeftBox = $employee_issueReport;
						}
						else if($empLink == 'liPassChange'){
							$empLeftBox = $changePinForm;
						}
						else if($empLink == ''){

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



					/*
				if(! $var == null){
					if($this->model->isUserLoggedInAdmin()){
						$introTop = $username . " : " . $empnumber;
						include_once'./templates/template_index_admin.php';
					}
					else
						$introTop = $username . " : " . $empnumber;
						include_once'./templates/template_index_employee.php';
				}
				else{
					$introTop = $username . " : " . $ponumber;
					include_once'./templates/template_index.php';
				}*/
				
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

			
			/*
			if( $var_loggedIn == null){
				include_once ("templates/template_index_login.php");
			}
			else{
				if($var == null){
					if($this->model->isUserLoggedInAdmin()){
						$introTop = $username . " : " . $empnumber;
						include_once'./templates/template_index_admin.php';
					}
					else{
						$introTop = $username . " : " . $empnumber;
						include_once'./templates/template_index_employee.php';
					}
				}
				else{
					$introTop = $username . " : " . $ponumber;
					include_once'./templates/template_index.php';
				}


			}*/

			include_once ("templates/template_index_login.php");
			/*
			if (! isset ( $this->model->hasRegistrationFailed )) {
				$rightBox = $registrationForm;
			} else if ($this->model->hasRegistrationFailed) {
				$rightBox = $newUserErrorMessage . $registrationForm;
			} else if ($this->model->hasRegistrationFailed == false) {
				$confirmationMessage = "<div class='alert alert-success'>" . $this->model->signUpConfirmation . "</div>";
				$rightBox = $confirmationMessage;
			}*/
			
		}
		
	}
}
?>