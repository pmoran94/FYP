<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Current Active Ticket Expiry: </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table-hover' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";

echo "</thead>";

$expiry = $this->model->getCurrentCParkExpiryTime();
	echo "<tr><td>" . $expiry. "</td>";
	echo "</tr>";

//<a><span class='glyphicon glyphicon'></span></a></td><td><a><span class='glyphicon glyphicon-remove'></span></a>
echo "</table>";
echo "</div>";
?>

<html>
<head>
<link href ="css/misc.css" rel="stylesheet" type="text/css">
</head>
</html>