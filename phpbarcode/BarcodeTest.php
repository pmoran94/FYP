<?php 
// include Barcode39 class 
include "Barcode39.php"; 

// set Barcode39 object 
$bc = new Barcode39("Paul Moran"); 

// display new barcode 
$bc->draw();
?>