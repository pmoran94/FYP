<?php
class validation_factory_admin {
	private $employeesDAO;
	public function __construct($employeesDAO) {
		//use the usersDAO in this script
		$this->employeesDAO = $employeesDAO;
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

			$empNum = rand(111111,999999);

			if( $this->employeesDAO->isEmpNumValid($empNum)){
				$flag = 0 ;
			}
			else
				$flag =1;
		}

		return ($empNum);
	}
}
?>