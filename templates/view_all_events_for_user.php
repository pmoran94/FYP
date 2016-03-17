<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>MyEvents </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Host:   </th>
<th>Event:   </th>
<th>Location:   </th>
<th>Date-Time:   </th>
<th>No. Of Invites:   </th>
<th>Active:   </th>
<th colspan='2'>Action: </th>
</tr>";

echo "</thead>";

foreach ($this->model->allEventsForUser as $row){
	echo "<td>" . $row ['creator_id'] . "</td>";
	echo "<td>" . $row ['nameOfEvent'] . "</td>";
	echo "<td>" . $row ['eventLocation'] . "</td>";
	echo "<td>" . $row ['dateOfEvent'] . "</td>";
	echo "<td>" . $row ['no_of_invitees'] . "</td>";
	echo "<td>" . $row ['active'] . "</td>";
	echo "<td><a><span class='glyphicon glyphicon'></span></a></td><td><a><span class='glyphicon glyphicon-remove'></span></a></td>";
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