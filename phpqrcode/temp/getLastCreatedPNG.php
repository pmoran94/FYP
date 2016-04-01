<?php

//preg_match("/PHP/", "PHP")

$path = 'temp/'; 
foreach (new DirectoryIterator('.') as $file) {
    if(strpos($file->getFilename(),'996f') !== false) 
    	echo $file->getFilename() . '<br>';
    	
}
//if (strpos("bfsbfksbfksbfkbPaulMorandfkgj.php", 'kbPauk') !== false) echo 'true';
//else echo 'false';
?>
