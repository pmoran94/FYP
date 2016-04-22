<?php
/*

*	@author : Paul Moran

*	@Date :  25/02/2016

	**Scanned Data Controller**

*	Script to read data from Excel file. 
	This data is broken up and validated using multiple checks from within the newly instantiated model.
*
	The overall result is pushed to the database along with a ticket to say whether or not the data scanned is valid or invalid.
*
	This file also ensures that not any employee scan any QR code.
*

*/
if(empty($_SESSION['user_id'])) die('Must be Logged in to see this page');

include_once './models/Model.php';

$model = new model();


//include_once 'db/simple_db_manager.php';
$db_link = mysqli_connect('localhost','root','','FYP');
include_once './PHPExcel/Classes/PHPExcel/IOFactory.php';  
$html=" <h2>Affected Data</h2><br>
		<table border='1'>";  
$validity = "";
$callDBQuery="";
$objPHPExcel = PHPExcel_IOFactory::load('./scannedDataExcel.xlsx');  
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

		if(strlen($name==27)) $eventID = $db_link->real_escape_string(substr($name,19,8));
	   	else $eventID = null;

	   	if(strlen($name==23)) $regNumbers = $db_link->real_escape_string(substr($name,19,4));
	   	else $regNumbers = null;

	   	$activeEventID = $model->getEventID();


	   	//CHECK IF THE EMPLOYEE HAS THE PRIVILEGE TO SCAN THIS QR CODE 
	   	$service = $model->getEmployeeService();

	   	if($service == $ticketType || $service == ""){
	   		if($ticketType == 'STAMP'){
	   			if($model->isStampActive($ticketID)){
		   			if($model->hasTicketBeenScannedBefore($ticketID)){
						if($model->didSecondEmployeeScan($ticketID)){
							$model->deactivateStampInStampsTable($ticketID);
							$model->updateTIDValidityApprove($ticketID);
							$model->updateScanOnArr($ticketID);
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
		   				if($model->hasFineBeenIssued($ticketID)){
		   					$validity = "Fine Already Issued";
		   					$model->deactivateCParkTicketInPTTable($ticketID);
		   				}
		   				else{
							if(/*$model->hasCParkExpiryTimeBeenReached($ticketID*/!$model->hasCParkPaymentBeenMade($ticketID)){
								$validity = 'Expired';
								$model->updateTIDValidityExpired($ticketID);
								$model->deactivateCParkTicketInPTTable($ticketID);
								//ISSUE FINE BY BUTTON PRESS
							}
							else{
								$validity = "Valid";
								$model->updateTIDValidityValid($ticketID);
							}
						}
					}
					else
					{ 
						if($model->hasCParkPaymentBeenMade($ticketID)/* &&  !$model->hasCParkExpiryTimeBeenReached($ticketID)*/){
							$validity = 'Valid';
							$model->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);
							$model->updateScannedDataInPTTable($ticketID);
						}
						else{
							$validity='Expired';
							$model->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);
							$model->deactivateCParkTicketInPTTable($ticketID);
							$model->updateScannedDataInPTTable($ticketID);
							//ISSUE FINE BY BUTTON PRESS
						}
					}
				}
				else 
					if(!$model->hasCPTicketBeenScanned($ticketID)){
						$validity = 'Valid';

						//$model->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);//Provide Registration Details
						//Notify User of Inactive Ticket, If Registration Matches then issue Fine and delete from scanned data
					}
					else
						$validity = 'Valid';
						//$model->updateTIDValidityInactive($ticketID); //Provide Registration Details
						//Notify User of Inactive Ticket, If Registration Matches then issue Fine
	   		}
	   		else if($ticketType == 'EVENT'){
	   			if($activeEventID == $eventID){
	   				if( ! $model->hasInviteAlreadyBeenScanned($ticketID)){
	   					$validity = "Valid";
	   					$model->insertIntoScannedData($ticketType,$ponumber,$ticketID,$eventID,$validity);
	   					$model->updateAttendedStatus($ticketID);
	   					$model->incrementAttendeesField($eventID);
	   				}
	   				else
	   					$validity = "Pre-scanned Ticket";
				}
				else{
					$validaty = "Invalid";
				}
	   		}
	   		else{
	   			$ticketType="Invalid";
	   			$ponumber="Invalid";
	   			$ticketID="Invalid";
	   			$eventID="Invalid";
	   			$validity="Invalid";
	   		}
	   			
	   			
	   	}
        $html.= '<td>'.$ticketType.'</td>';  
        $html .= '<td>'.$ponumber.'</td>';  
        $html .= '<td>'.$ticketID.'</td>';
        $html .= '<td>'.$eventID.'</td>';
        $html .= '<td>'.$validity.'</td>';
        $html .= "</tr>";  
 	}  
}  
$html .= '</table>';  
if($service == 'EVENT' && $activeEventID == false)
	$html .= "<h4 style=color:red>Note : Event ID not Set</h4>";
echo $html;  
echo "<br /><a href='?eUserValue=viewScannedData'><button class='btn btn-warning'>View Scanned Data</button>";

?>  