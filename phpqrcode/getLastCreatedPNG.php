<?php

//preg_match("/PHP/", "PHP")
$QRTicket = $

$path = 'temp/'; 
foreach (new DirectoryIterator($path) as $file) {
    if(strpos($file->getFilename(),'996f') !== false) 
    	$QRTicket = $file->getFilename();
    	//echo $file->getFilename() . '<br>';
}
?>
