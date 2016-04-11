<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Stamps </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Event Name:   </th>
<th>Description:   </th>
<th>Invite Type:   </th>
<th>Host:   </th>
<th>No. Of Invitees:   </th>
<th>No. Of Attendees:   </th>
<th>Creation Date:   </th>
<th>Date of Event:</th>
<th>Location:</th>
<th>Event ID:</th>
<th>Active?:</th>
<th>Remove: </th>
</tr>";

echo "</thead>";
foreach ($this->model->allEvents as $row){
	echo "<td>" . $row ['nameOfEvent'] . "</td>";
	echo "<td>" . $row ['eventDesc'] . "</td>";
	echo "<td>" . $row ['inviteType'] . "</td>";
	echo "<td>" . $row ['creator_id'] . "</td>";
	echo "<td>" . $row ['no_of_invitees'] . "</td>";
	echo "<td>" . $row ['no_of_attendees'] . "</td>";
	echo "<td>" . $row ['dateOfCreation'] . "</td>";
	echo "<td>" . $row ['dateOfEvent']."</td>";
	echo "<td>" . $row ['eventLocation'] . "</td>";
	echo "<td>" . $row ['eventID'] . "</td>";
	echo "<td>". $row ['active']."</td>";
	echo "<td><a><span class='glyphicon glyphicon-menu-alt'></span></a></td>";
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