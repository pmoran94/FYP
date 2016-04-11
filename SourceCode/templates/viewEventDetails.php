<?php

include_once './db/simple_db_manager.php';
echo "<div class='col-lg-2'>";
echo "</div>";
echo "<div style='overflow:auto; margin-left:' class='col-lg-8'>";
echo "<div ><h3>Event Details </h3></div>";
echo "<table class= 'table table-hover ' border='0' style='width:100%; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Field   </th>
<th>Details   </th>  
</tr>";

echo "</thead>";
foreach ($this->model->eventDetails as $row){
	echo "<tr><td>Event ID :</td><td>" . $row ['eventID'] . "</td></tr>";
	echo "<tr><td>Event Name :</td><td>". $row ['nameOfEvent'] ."</td></tr>";
	echo "<tr><td>Host :</td><td>" . $row ['creator_id'] . "</td></tr>";
	echo "<tr><td>Description :</td><td>" . $row ['eventDesc'] . "</td></tr>";
	echo "<tr><td>Date :</td><td>" . $row ['dateOfEvent'] . "</td></tr>";
	echo "<tr><td>Location :</td><td>" . $row ['eventLocation'] . "</td></tr>";
	echo "<tr><td>No. of Invites :</td><td>" . $row ['no_of_invitees'] . "</td></tr>";
	echo "<tr><td>Invite Type :</td><td>" . $row ['inviteType'] . "</td></tr>";
	echo "<tr><td>Active :</td><td>" . $row ['active'] . "</td></tr>";
	echo "<tr><td></td><td><form action=index.php method=post >
			<input type='hidden' name='action' value='deleteEvent'>
			<input type='hidden' name='ev_ID' value='".$row['eventID']."'>
			<button type='submit' class='btn btn-danger'>Delete</button></form></td></tr>";
}
echo "</table>";
echo "</div>";



echo "<div class='col-lg-2'>";
echo "</div>";
?>

<html>
<head>

<link href ="css/misc.css" rel="stylesheet" type="text/css">
</head>
</html>