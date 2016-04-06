<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Scanned Data </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table-hover' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Ticket Type:   </th>
<th>Ticket ID:   </th>
<th>PO Number:   </th>
<th>Validity:   </th>
<th colspan='3'>Action:</th>
</tr>";

echo "</thead>";

foreach ($this->model->getScannedDataForEmployee as $row){
	echo "<tr><td>" . $row ['ticketType'] . "</td>";
	echo "<td>" . $row ['ticketID'] . "</td>";
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>" . $row ['validity'] . "</td>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='hidden' name='ticketID' value='".$row['ticketID']."'>";
	echo "<td><button class='btn btn-warning' type='button' name='action' value=''><span class='glyphicon glyphicon-remove'></span></button>";
	echo "&nbsp&nbsp&nbsp<button class='btn btn-default' type='button' name='action' value=''><span class='glyphicon glyphicon-envelope'></span></button>";
	echo "&nbsp&nbsp&nbsp<button class='btn btn-success' type='button' name='action' value=''><span class='glyphicon glyphicon-envelope'></span></button></td>";
	echo "</form>";
	echo "</tr>";
}
//<a><span class='glyphicon glyphicon'></span></a></td><td><a><span class='glyphicon glyphicon-remove'></span></a>
echo "</table>";
echo "</div>";
?>

<html>
<head>
<link href ="css/misc.css" rel="stylesheet" type="text/css">
</head>
</html>