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


		$authenticationErrorMessage = "";
		$leftBox = "";
		$rightBox = "";
		$middleBox = "";
		$introTop="";
		$confirmationMessage = "";
		$displayTables = "";
		$tableChoice = null;

		
		if ($this->model->loginStatusString != null) {
				
				$username = $this->model->authenticationFactory->getUsernameLoggedIn();
				$ponumber = $this->model->authenticationFactory->getPONumberLoggedIn();
				$empnumber = $this->model->authenticationFactory->getEmpNumberLoggedIn();
				$loginBox = "<a href='index.php?action=logout'>" . $this->model->loginStatusString . "</a>";
				
				$var = $this->model->authenticationFactory->isUserEmployee();
				
				if(! $var == null){
					if($this->model->isUserLoggedInAdmin()){
						$newVar = "<h2 style='color:red;size:20'>You are an Admin</h2>";
						//$introTop = $username . " : " . $empnumber;
						
						if(isset($_POST["registerAdmin"])){
							$rightBox = $registrationAdminForm;
						}
						else if( isset($_POST["deleteAdmin"])){
							$rightBox = $deleteEmployee;
						}
						else if( isset($_POST["deleteCustomer"])){
							$rightBox = $deleteCustomer;
						}
						else if(isset($_POST["changePin"])){
							$rightBox = $changePinForm;
						}
						else
							$rightBox = "<img src='./images/cus1.jpe' alt='Admin'>"  . $newVar  ;
						
					}else
						$newVar = "<h2 style='color:red;size:20'>You are an Employee</h2>";
						//$introTop = $username . " : " . $empnumber;
						$rightBox = "<img src='./images/cus1.jpe' alt=''>"  . $newVar  ;
				}
				else
					$newVar = "<h2 style='color:red;size:20'>You are a Customer - </h2>";
			

					$introTop = $username . " : " . $ponumber;
					
					$link=$_GET['button'];
					if (empty($link)) $link = '';

					if($link == 'liReport'){
						$leftBox = $issueReport;
					}
					else if($link=='liCreateEvent'){
						$leftBox = $emailsForm;
					}
					else if($link == 'liCreateStamp'){
						$leftBox = $stampForm;
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

				// list of options available to logged in user
					$rightBox = $newVar  ;


				$middleBox = $loggedInUserActions;


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
				}
				
		}
		// The  Admin view has be completely taken out here
		else {


			$loginBox  = $loginBar;

			$authenticationErrorMessage = "";
			
			if ($this->model->hasAuthenticationFailed)
				$authenticationErrorMessage = $this->model->authenticationErrorMessage;
		

			$link = $_GET['buttonLogin'];
			if (empty($buttonLogin)) $buttonLogin = '';

			if($link == 'registerbutton' ){
				$middleBox = $registrationForm ; 
			}
			else{
				$middleBox = $cusloginBox ; 
			}
			
			//$rightBox = "<img src='./images/cus1.jpe' alt='Customer'>"; 
			$leftBox = "<img src='./images/envelope.png' alt='envelope'>";

			


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