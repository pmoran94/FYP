<?php
/*	

	Author @: Paul Moran
	
	The following code is used to find the correct QR code to be displayed after 
	generation based on the ticketID.
	
*/

$ticketToDisplay;

$path = 'temp/'; 
foreach (new DirectoryIterator($path) as $file) {
    if(strpos($file->getFilename(),'2823455') !== false) 
    	echo $file->getFilename() . '<br>';
    	$ticketToDisplay = $file->getFilename();
    	
}
?>
