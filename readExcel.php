<?php


ini_set("display_errors",1);

//include_once 'db/simple_db_manager.php';
$db_link = mysqli_connect('localhost','root','','FYP');
include_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';  
$html="<table border='1'>";  
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

		   	//FIRST CHECK IF THE TICKET ID IS IN THE DATABASE ALREADY

		   	// check the ticket type 
		   		//call appropriate function for that type
		   	// EVENT -  has ticket been scanned already
		   	// EVENT - is Event Active
		   	// Event - does the ticket match that event
		   	// Prompt ticket holder for ID

		   	//STAMP -  Is it the first time its been scanned
		   	// HAS IT BEEN PAID FOR
		   	// PROMPT FOR WEIGHT , DESTINATION,TYPE
		   	// IF ITS THE SECOND AND THE TIME IT WAS FIRST SCANNED WAS THE SAME DAY THEN DONT ACCEPT

		   	// IS THE EXPIRY TIME STILL DUE
		   	// HAS THERE BEEN A PAYMENT

		   	$validity = true;
		   	$fail_reason = "";



           $sql = "INSERT INTO scanned_data(ticketType,ponumber,ticketID,eventID,validity,fail_reason) VALUES ('".$ticketType."', '".$ponumber."', '".$ticketID."','".$eventID."','".$validity."','".$fail_reason."')";  
           mysqli_query($db_link, $sql);  
          

           $html.= '<td>'.$ticketType.'</td>';  
           $html .= '<td>'.$ponumber.'</td>';  
           $html .= '<td>'.$ticketID.'</td>';
           $html .= '<td>'.$eventID.'</td>';
           $html .= '<td>'.$validity.'</td>';
           $html .= '<td>'.$fail_reason.'</td>';
           $html .= "</tr>";  
      }  
 }  
 $html .= '</table>';  
 echo $html;  
 echo '<br />Data Inserted';  
 ?>  