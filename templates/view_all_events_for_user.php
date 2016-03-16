<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>MyEvents </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table-hover ' border='1' style='text-align:left; background-color:skyblue; color:black; margin:0px'>";
echo "<thead style='background-color:cyan'>";
echo "<tr>
<th>Host:   </th>
<th>Event:   </th>
<th>Location:   </th>
<th>Date-Time:   </th>
<th>No. Of Invites:   </th>
<th>Active:   </th>
</tr>";

echo "</thead>";
foreach ($this->model->allEventsForUser as $row){
	echo "<td>" . $row ['creator_id'] . "</td>";
	echo "<td>" . $row ['nameOfEvent'] . "</td>";
	echo "<td>" . $row ['eventLocation'] . "</td>";
	echo "<td>" . $row ['dateOfEvent'] . "</td>";
	echo "<td>" . $row ['no_of_invitees'] . "</td>";
	echo "<td>" . $row ['active'] . "</td>";
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