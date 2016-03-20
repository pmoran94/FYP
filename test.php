<?php

$amount = 1000;
$currentParkingPrice = 160;

$currentExpiry = '2016-03-20 20:30:00';

$var = round($amount/$currentParkingPrice,2);
//$var = round(100/10,2);

if(is_float($var))
	$str_arr = explode('.',$var);
	$befDec = $str_arr[0];

	if(! empty($str_arr[1])) $aftDec = $str_arr[1];
	else $aftDec = null;
	
	if(empty($aftDec))
		$minutes = 0;
	else $minutes = round($aftDec*.6);



echo $amount . "<br>";
echo $currentParkingPrice. "<br>";
echo $var. "<br>";
echo $aftDec. "<br>";
echo $befDec. "<br>";
echo "Added Time to Expiry : " . $befDec ." hour(s) and " . $minutes .  " minutes.<br>"; 

echo date('Y-m-d H:i:s',strtotime($currentExpiry) + (60*60*$befDec)+60*$minutes); 
echo "<br> -----------------------------------------------------------------------<br>";




?>