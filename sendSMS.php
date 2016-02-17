<?php
/*
The following script is executed to send a text message to a user when needed.
*/ 

$message = "";
$username = "pmoran94";
$password = "NOYJAdWTECgEQL";


$url = "http://api.clickatell.com/http/sendmsg?user=".$username."&password=".$password."&api_id=3583573&to=353".$mobile."&text=Message";

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

?>