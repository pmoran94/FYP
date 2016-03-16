<?php

/*
	Script to write created data to a text file to be read from for sample data.
	Data will only be written to the file when Parking Ticket is scanned.
	But at the minute , all data will be wrote to it as sample data.
*/


$dataArray = [];
$ticketID = "";
$ponumber = "";

$myfile = fopen("scannedParkingData.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  array_push($dataArray,fgets($myfile));
}
fclose($myfile);


//echo strtotime("now") . "<br>";

$time = date('Y-m-d H:i:s');


//echo strtotime($time);



echo "<div style='overflow:auto;'>";
echo "<table class='table border='1' style='width:100%; text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Ticket: </th>
<th>PO Number: </th>
<th>Status:</th>
<th colspan='2'>Action:</th>
</tr>";
echo "</thead>";
/**
	1.QUERY THAT THE TICKET BELONGS TO THE REGISTRATION
	2.QUERY THAT THE TICKET IS ACTIVE.
	3.QUERY THAT THE TICKET IS PAID FOR.
	4.QUERY THAT THE TICKET IS FULLY VALID., ie. IN DATE, PAID FOR , WITH CORRECT CAR, ACTIVE. ETC.
*/

foreach($dataArray as $string){
	$ticketID = substr($string,5,7) . "<br>";
	$ponumber = substr($string,12) . "<br>";
	//echo $string . "<br>";

	if($this->model->validationFactory->IsTicketActive($ticketID))
		if($this->model->validationFactory->ticketPaidFor($ticketID))
			if($this->model->validationFactory->validExpiry($ticketID))
				$validity = "Valid";
			else $validity = "Expired";
		else $validity = "No Payment Made";
	else $validity = "Ticket Inactive";

	// does the ticket belong to the reg

//	$validity = 'Not Processed';

	echo "<tr><td>". $ticketID ."</td><td>". $ponumber ."</td><td>".$validity."</td><td><a href='#''><span class='glyphicon glyphicon-ok'></span></a></td><td><a href='#'><span class='glyphicon glyphicon-list-alt'></span></a></td></tr>";
}

echo "</table>";
echo "</div>";

?>