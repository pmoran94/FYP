<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Stamps </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class='table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Creator:   </th>
<th>Issue Date:   </th>
<th>Last Expiry Date:   </th>
<th>Ticket ID:   </th>
<th>Time of First Payment:   </th>
<th>Paid?:   </th>
<th>Active:</th>
<th colspan='2'>Action:  </th>
</tr>";

echo "</thead>";

foreach ($this->model->allCParkTickets as $row){
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>" . $row ['date_issued'] . "</td>";
	echo "<td>" . $row ['date_of_expiry'] . "</td>";
	echo "<td>" . $row ['ticketID'] . "</td>";
	echo "<td>" . $row ['timeOfLastPayment'] . "</td>";
	echo "<td>" . $row ['has_paid'] . "</td>";
	echo "<td>" . $row ['active']. "</td>";
	echo "<td><a><span class='glyphicon glyphicon-menu-alt'></span></a></td><td><a><span class='glyphicon glyphicon-remove'></span></a></td>";
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