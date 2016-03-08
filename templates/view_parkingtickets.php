<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Stamps </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table-hover ' border='1' style='text-align:left; background-color:skyblue; color:black; margin:0px'>";
echo "<thead style='background-color:cyan'>";
echo "<tr>
<th>Creator:   </th>
<th>Issue Date:   </th>
<th>Last Expiry Date:   </th>
<th>Ticket ID:   </th>
<th>Time of First Payment:   </th>
<th>Paid?:   </th>
</tr>";

echo "</thead>";
foreach ($this->model->allCParkTickets as $row){
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>" . $row ['date_issued'] . "</td>";
	echo "<td>" . $row ['date_of_expiry'] . "</td>";
	echo "<td>" . $row ['ticketID'] . "</td>";
	echo "<td>" . $row ['timeOfFirstPayment'] . "</td>";
	echo "<td>" . $row ['hasPaid'] . "</td>";
	echo "</tr>";
}
echo "</table>";
echo "</div>";
?>

<html>
<head>
<link href ="css/misc.css" rel="stylesheet" type="text/css">
</head>
</html>