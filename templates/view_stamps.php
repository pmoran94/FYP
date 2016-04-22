<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Stamps </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Customer:   </th>
<th>Dep. Scann:   </th>
<th>Arr. Scann:   </th>
<th>Stamp ID:   </th>
<th>Destination:   </th>
<th>Weight:   </th>
<th>Type:   </th>
<th>Paid?:</th>
<th colspan='2'>Action:  </th>
</tr>";

echo "</thead>";

foreach ($this->model->allStamps as $row){
	echo "<td>" . $row ['generatedBy'] . "</td>";
	echo "<td>" . $row ['scannedOnDep'] . "</td>";
	echo "<td>" . $row ['scannedOnArr'] . "</td>";
	echo "<td>" . $row ['stampID'] . "</td>";
	echo "<td>" . $row ['destination'] . "</td>";
	echo "<td>" . $row ['weight'] . "</td>";
	echo "<td>" . $row ['type'] . "</td>";
	echo "<td>". $row ['paidFor']."</td>";
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