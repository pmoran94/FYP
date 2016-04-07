<?php
include_once './models/Model.php';

/*

	Not implemented Due to not being Deployed.
	
*/

class cronConroller{


	private $model;
	
	public function_construct(){
		$this->model = new model();
	}


	$sampleQRTYPE = "Hello";  

	if(isset($sampleQRTYPE))
		testCron($sampleQRTYPE); 

	public function testCron($sampleQRTYPE){

		$this->model->qrticketsDAO->insertNewQRCodeTEST($sampleQRTYPE);

	}
}
?>