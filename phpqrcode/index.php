<?php    

/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */


//if(empty($_SESSION['user_id'])) die('Must be Logged in to see this page');

$currentUserId = $_GET['ponumber'];
$ticketID = $_GET['ticketID'];
$eventID = $_GET['eventID'];
$qrPurpose = $_GET['genButton'];

if($qrPurpose == 'cpark'){
    $ticket = genCparkData($currentUserId,$ticketID);
}
else if($qrPurpose == 'event'){
    $ticket = genEventData($currentUserId,$ticketID,$eventID);
}
else if($qrPurpose == 'stamp'){
    $ticket = genStampData($currentUserId,$ticketID);
}
else{
    $ticket = "";
}

function genStampData($currentUserId,$ticketID){
    $ticketType = "STAMP";

    return $ticketType . $currentUserId . $ticketID . '\n';
}
function genCparkData($currentUserId,$ticketID){
    $ticketType = "CPARK";

    return $ticketType . $currentUserId . $ticketID . '\n';
}
function genEventData($currentUserId,$ticketID, $eventID){
    $ticketType = "EVENT";

    return $ticketType . $currentUserId . $ticketID . $eventID . '\n' ;
}


    //echo "<h1>PHP QR Code --  " . $ticket . "</h1><hr/>";
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($ticket)) { 
    
        //it's very important!
        if (trim($ticket) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        
        $filename = $PNG_TEMP_DIR. $ticketID .md5($ticket.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    
        QRcode::png($ticket, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/> ' ;    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
    //display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    //config form

    /*
    echo '<form action="index.php" method="post">
        Data:&nbsp;<input name="data" value="'.(isset($myvar)?htmlspecialchars($myvar):'PHP QR Code :)').'" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;
        <input type="submit" value="GENERATE"></form><hr/>';
        
    // benchmark
    QRtools::timeBenchmark();    */

    