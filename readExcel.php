<?php
/*

	@Author : Paul Moran

	@Date :  25/02/2016

	Script to read data from Excel file. 
	This data is broken up and validated using multiple checks from within the newly instantiated model.

	The overall result is pushed to the database along with a ticket to say whether or not the data scanned is valid or invalid.

	This file also ensures that not any employee scan any QR code.


*/
if(empty($_SESSION['user_id'])) die('Must be Logged in to see this page');

include_once 'models/Model.php';

$model = new model();


//include_once 'db/simple_db_manager.php';
$db_link = mysqli_connect('localhost','root','','FYP');
include_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';  
$html=" <h2>Affected Data</h2><br>
		<table border='1'>";  
$validity = "";
$callDBQuery="";
$objPHPExcel = PHPExcel_IOFactory::load('scannedDataExcel.xlsx');  
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   
{  
    $highestRow = $worksheet->getHighestRow();  
    for ($row=1; $row<=$highestRow; $row++)  
    {  
        $html.="<tr>";  
        $name = mysqli_real_escape_string($db_link, $worksheet->getCellByColumnAndRow(0, $row)->getValue());  
      
        $ticketType = $db_link->real_escape_string(substr($name,0,5));
   	    $ticketID = $db_link->real_escape_string(substr($name,12,7));
 	    $ponumber = $db_link->real_escape_string(substr($name,5,7));

		if(strlen($name>18)) $eventID = $db_link->real_escape_string(substr($name,19,7));
	   	else $eventID = null;

	   	//CHECK IF THE EMPLOYEE HAS THE PRIVILEGE TO SCAN THIS QR CODE 
	   	$service = $model->getEmployeeService($ticketType);

	   	$updateTIDValidity='';

	   	if($service == $ticketType || $service == ""){
	   		if($ticketType == 'STAMP'){
	   			if($model->isStampActive($ticketID)){
		   			if($model->hasTicketBeenScannedBefore($ticketID)){
						if($model->didSecondEmployeeScan($ticketID)){
							$model->deactivateStampInStampsTable($ticketID);
							$model->updateTIDValidityApprove($ticketID);
						}
						else{
							$model->updateTIDValidityCheckDestination($ticketID);
						}
					}
					else{
						/*
							This should be first check for a valid in-date ticket less than 2 weeks old.
						*/ 

						$validity = 'valid';
						$model->updateScanOnDepart($ticketID);
						$model->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);
					}	
				}
				else{
					$validity = "Inactive";
					// notify user of inactive stamp
					if(!$model->hasTicketBeenScannedBefore($ticketID))
						$hello = '';
						//$model->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);
				}
	   		}
	   		else if($ticketType == 'CPARK'){
	   			if($model->isCPARKActive($ticketID)){
		   			if($model->hasCPTicketBeenScanned($ticketID)){
						$callDBQuery = null;
						if(! $model->hasCParkExpiryTimeBeenReached($ticketID)){
							return true;
						}
						else{
							$updateTIDValidity=$ticketID;
							return false;
						}
					}
					else
					{ 
						if($model->hasValidPaymentBeenMade)
							if(! $model->hasCParkExpiryTimeBeenReached($ticketID))
								return true;
						return false;
					}
		   	
					$callDBQuery = '';
					$validity = 'Not Relevant';
				}
	   		}
	   		/*
	   		else if($ticketType == 'EVENT'){
	   			$validity;//checkEvent($ticketType,$ticketID,$eventID,$callDBQuery,$updateTIDValidity);
   				if( ! $model->hasTicketBeenScanned($ticketType,$ticketID)){
					$callDBQuery = 'insert';
					if($model->eventIDmatchesEvent($eventID))
						if($model->eventIsActive)
							if($model->eventIsToday)
								return true;
				}
				else{
					$callDBQuery = 'update';
					$updateTIDValidity = $ticketID;
					return false;
				}
	   		}
	   		else
	   			$validity = 'Not Relevant';
	   			*/
	   	}
	   		   			

        $sql = "INSERT INTO scanned_data(ticketType,ponumber,ticketID,eventID,validity) VALUES ('".$ticketType."', '".$ponumber."', '".$ticketID."','".$eventID."','".$validity."')"; 

        $sqlUpd = "UPDATE scanned_data SET validity='false' WHERE ticketID = '".$updateTIDValidity."'";

       	if($callDBQuery == 'insert')
       		//mysqli_query($db_link, $sql);
       		$hello = '';
       	else if($callDBQuery == 'update')
       		mysqli_query($db_link,$sqlUpd);  
      

        $html.= '<td>'.$ticketType.'</td>';  
        $html .= '<td>'.$ponumber.'</td>';  
        $html .= '<td>'.$ticketID.'</td>';
        $html .= '<td>'.$eventID.'</td>';
        $html .= '<td>'.$validity.'</td>';
        $html .= "</tr>";  
 	}  

function checkStamp($ticketType,$ticketID,&$callDBQuery,&$updateTIDValidity){
	if($model->hasTicketBeenScanned($ticketType,$ticketID)){
		$callDBQuery = null;
		if($model->validLastScanTimeInterval($ticketID)){
			return true;
		}
		else{
			$callDBQuery = 'update';
			$updateTIDValidity=$ticketID;
			return false;
		}
	}
	else{ 
		$callDBQuery = 'insert';
		if($model->isStampExpiryTimeValid($ticketID)){
			return true;
		}
		else{
			$updateTIDValidity = $ticketID;
			return false;
		}
	}
}


function checkCPark($ticketType,$ticketID,&$callDBQuery,&$updateTIDValidity){
	if($model->hasTicketBeenScanned($ticketType,$ticketID)){
		$callDBQuery = null;
		if(! $model->hasCParkExpiryTimeBeenReached($ticketID)){
			return true;
		}
		else{
			$callDBQuery='update'; 
			$updateTIDValidity=$ticketID;
			return false;
		}
	}
	else
	{ 
		$callDBQuery = 'insert';
		if($model->hasValidPaymentBeenMade)
			if(! $model->hasCParkExpiryTimeBeenReached($ticketID))
				return true;
		return false;
	}
}


function checkEvent($ticketType,$ticketID,$eventID,&$callDBQuery,&$updateTIDValidity){
	if( ! $model->hasTicketBeenScanned($ticketType,$ticketID)){
		$callDBQuery = 'insert';
		if($model->eventIDmatchesEvent($eventID))
			if($model->eventIsActive)
				if($model->eventIsToday)
					return true;
	}
	else{
		$callDBQuery = 'update';
		$updateTIDValidity = $ticketID;
		return false;
	}
}

}  
$html .= '</table>';  
echo $html;  
echo "<br /><a href='?eUserValue=viewScannedData'><button class='btn btn-warning'>View Scanned Data</button>";

?>  