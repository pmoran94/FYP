<?php

$strValue = "abcdefg";
$numValue = "123456";

if(is_numeric($numValue)){
	echo "<p> numValue is numeric</p>";
}
else
	echo "<p> numValue is not numeric</p>";

if(strlen($numValue)==6)
	echo "<p> numValue Works </p>";
else
	echo "<p>numValue does not work</p>";
?>