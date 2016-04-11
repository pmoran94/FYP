<?php
class validation_factory {
	private $customersDAO;
	private $employeesDAO;
	private $qrticketsDAO;

	public function __construct($customersDAO,$employeesDAO,$qrticketsDAO) {
		//use the usersDAO in this script
		$this->customersDAO = $customersDAO;
		$this->employeesDAO = $employeesDAO;
		$this->qrticketsDAO = $qrticketsDAO;
	}

	/**
	 * check whether the email string is a valid email address using a regular expression
	 * @param $emailStr - the input email string
	 * @return boolean indicating whether it is a valid email or not
	 */
	public function isEmailValid($emailStr){
	////
	//   ASK ASK ABOUT THE LINE BELOW
	
		$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";
		if(!preg_match($regex, $emailStr)) return (false);
		else return (true);
	}
	public function didSecondEmployeeScan($empNo,$ticketID){
		$firstScanEmpNo = $this->qrticketsDAO->getFirstTimeStampScanEmpNo($ticketID);

		if($firstScanEmpNo == $empNo) return false;
		else return true;
	}
	public function isStampActive($ticketID){
		$active = $this->qrticketsDAO->isStampActive($ticketID);

		if($active == 'no') return false;
		else return true;
	}
	public function isCPARKActive($ticketID){
		$active = $this->qrticketsDAO->isCPARKActive($ticketID);

		if($active == 'no') return false;
		else return true;
	}

	public function hasCParkExpiryTimeBeenReached($ticketID){
		$currentTime = date('Y-m-d h:i:s');
		if($this->qrticketsDAO->getQRExpiryTime($ticketID)>=$currentTime) return true;
		return false;
	}

	public function hasCPTicketBeenScanned($ticketID){
		return($this->qrticketsDAO->hasCPTicketBeenScanned($ticketID));
	}

	public function IsTicketActive($ticketID){
		return($this->qrticketsDAO->IsTicketActive($ticketID));
	} 
	public function ticketPaidFor($ticketID){
		return($this->qrticketsDAO->ticketPaidFor($ticketID));
	}
	public function validExpiry($ticketID){
		return($this->qrticketsDAO->validExpiry($ticketID));
	}

	public function validPassword($password){
		$regex = "^                                       
				(?=(?:.*[A-Z]){2,})                     
				(?=(?:.*[a-z]){2,})                      
				(?=(?:.*\d){2,})                         
				(?=(?:.*[!@#$%^&*()\-_=+{};:,<.>]){2,})  
				(.{8,})                                  
				$  ";

		if(!preg_match($regex,$password)) return (false);
		else return (true);
	}


	public function isPinLengthValid($pin,$max_len,$min_len){
		//if(is_numeric($pin)){
			if( (strlen($pin)<=$max_len) && (strlen($pin)>=$min_len)) return (true);
			else return (false);
		//}
	}
	public function isEmpNumLengthValid($emp_no,$max_len){
		if(is_numeric($emp_no)){
			if( strlen($emp_no)==$max_len) return (true);
			else return (false);
		}
	}
	/**
	 * @param $string - the input string
	 * @param $maxchars - the maximum length of the input string
	 * @return boolean indicating whether it is a valid string of the right max length
	 */
	public function isLengthStringValid($string, $maxchars){
		if (is_string($string))
			if (strlen($string)<=$maxchars) return (true);	
		return (false);
	}

	public function isMobileValid($mobNum,$maxchars){
		if(is_numeric($mobNum)){
			if(strlen($mobNum)==$maxchars) {
				return (true);
			}
		}
		return (false);

	} 
	public function poNumGenerator(){


		$poNumber;
		$flag = 0;
		
		while($flag == 0){

			$poNumber = rand(1000000,9999999);

			if( $this->customersDAO->isPOnumValid($poNumber)){
				$flag = 0 ;
			}
			else
				$flag =1;
		}

		return ($poNumber);
	}

	public function empNumGenerator(){


		$empNum;
		$flag = 0;
		
		while($flag == 0){

			$empNum = rand(100000,999999);

			if( $this->employeesDAO->isEmpNumValid($empNum)){
				$flag = 0 ;
			}
			else
				$flag =1;
		}

		return ($empNum);
	}

	public function eventIDGenerator(){
		$eventID;
		$flag = 0;
		
		while($flag == 0){

			$eventID = rand(10000000,99999999);

			if( $this->qrticketsDAO->isEventIDValid($eventID)){
				$flag = 0 ;
			}
			else
				$flag =1;
		}

		return ($eventID);
	}
	public function inviteIDGenerator($eventID){
		$inviteID;
		$flag = 0;
		
		while($flag == 0){

			$inviteID = rand(1000000,9999999);

			if( $this->qrticketsDAO->isInviteIDValid($inviteID,$eventID)){
				$flag = 0 ;
			}
			else
				$flag =1;
		}

		return ($inviteID);
	}

	public function qrcodeIDGenerator(){
		$qrID;
		$flag = 0;
		
		while($flag == 0){

			$qrID = rand(1000000,9999999);

			if( $this->qrticketsDAO->isQRCodeIDvalid($qrID)){
				$flag = 0 ;
			}
			else
				$flag =1;
		}

		return ($qrID);
	}
	

}
?>