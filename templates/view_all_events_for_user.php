<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>MyEvents </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table-hover' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Event ID:   </th>
<th>Event:   </th>
<th>Date :   </th>
<th>Active:   </th>
<th></th>
</tr>";

echo "</thead>";

foreach ($this->model->allEventsForUser as $row){
	echo "<tr><td>" . $row ['eventID'] . "</td>";
	echo "<td>" . $row ['nameOfEvent'] . "</td>";
	echo "<td>" . $row ['dateOfEvent'] . "</td>";
	echo "<td>" . $row ['active'] . "</td>";
	echo "<td><a href='?userValue=viewEvent&evId=".$row['eventID']."'><button class='btn' type='button'>View Event</a></td>";
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