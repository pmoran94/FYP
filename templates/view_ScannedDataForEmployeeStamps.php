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
	$type = array("CPARK", "EVENT", "STAMP");
	if(in_array($row['ticketType'],$type)){
		echo "<td><button class='btn btn-warning' type='button' title='Remove Without Action' name='action' value=''><span class='glyphicon glyphicon-remove'></span></button>&nbsp&nbsp&nbsp<button class='btn btn-default' type='button' title='Issue Invalidity' name='action' value=''><span class='glyphicon glyphicon-envelope'></span></button>&nbsp&nbsp&nbsp<a href='?empButton=contactByNotification&ponumber=".$row['ponumber']."'><button class='btn btn-success' type='button' title='Notify Customer of Issue' ><span class='glyphicon glyphicon-envelope'></span></button></a></td>";
	}
	else{
		echo "<td><button class='btn btn-warning' type='button' title='Remove Without Action' name='action' value=''><span class='glyphicon glyphicon-remove'></span></button></td>";
	}
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