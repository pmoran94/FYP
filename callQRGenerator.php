<?php
/*
The following script is executed to send a text message to a user when needed.
*/ 


$genButton= "";

if($qrType == 'STAMP'){
	$genButton = 'stamp';
}
else if($qrType == 'CPARK'){
	$genButton = 'cpark';
}
else if($qrType == 'EVENT'){
	$genButton = 'event';
}
else die("Invalid Generation Type");

/*

	SHOULD ADD THE QRCODE ID TO THE QRCODE PRINTED OFF

*/


$url = "http://localhost/FYP/FYP/phpqrcode/index.php?genButton=$genButton&ponumber=$ponumber&ticketID=$ticketID&eventID=$eventID";


$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 20);
 
curl_exec($ch);
curl_close($ch);

?>