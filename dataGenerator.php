<?php
/*

Data Generator for QR Code 

*/


/* List of ALL possible datatypes which can be in the QR code as part of the application */


$timestamp = date("Y/m/dh:i:sa");
$currentUserId = $ponumber;
$ticketType = "";
$invitee = "";
$carRegistration = $carRegistrationview;
$eventID = "";
$ticketID = "";
$typeOfEntree = "";
$ticket = "";



$qrPurpose = $_GET['genButton'];

if($qrPurpose == 'cpark'){
	$ticketType = "CPARK";
}
else if($qrPurpose == 'event'){
	$ticketType = "EVENT";
}
else if($qrPurpose == 'stamp'){
	$ticketType = "STAMP";
	$ticket= $ticketType . $currentUserId . $timestamp;
}
else
	$ticketType = "";





?>