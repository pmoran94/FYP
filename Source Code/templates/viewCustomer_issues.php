<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Reported Issues </h3></div>";
echo "<div style='overflow:auto;height:200px;'>";
echo "<table class='table' style='width:100%; text-align:left; color:black; margin:0px'>";
echo "<thead >";
echo "<tr>
<th>Name:   </th>
<th>PO Number:   </th>
<th>Subject:   </th>
<th>Content:   </th>
<th>Date:   </th>
<th>Action:   </th>
</tr>";
echo "</thead>";

foreach ($this->model->allCustomerIssues as $row){
	echo "<td>" . $row ['name'] . "</td>";
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>" . $row ['subject'] . "</td>";
	echo "<td>" . $row ['content'] . "</td>";
	echo "<td>" . $row ['date_'] . "</td>";
	echo "<td><button type='submit' class='btn btn-default' title='Contact User By Online Notification' name='contactByNofication'><span class='glyphicon glyphicon-envelope'></span></button>&nbsp&nbsp&nbsp<button type='submit' class='btn btn-danger' title='Remove Issue' name='action' value='deleteCustIssue'><span class='glyphicon glyphicon-remove'></span></button></td>";
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