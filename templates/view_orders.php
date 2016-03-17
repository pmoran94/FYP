<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Customers Orders </h3></div>";
echo "<div style='overflow:auto;height:200px'>";
echo "<table class= 'table' style='text-align:left; color:black; margin:0px'>";
echo "<thead'>";
echo "<tr>
<th>ID  </th>
<th>Name:   </th>
<th>PO Number:   </th>
<th>Envelopes:   </th>
<th>Stickers:   </th>
<th>Date Ordered:   </th>
<th>Cost:   </th>
</tr>";

echo "</thead>";

foreach ($this->model->allOrders as $row){
	echo "<td>" . $row ['id'] . "</td>";
	echo "<td>" . $row ['username'] . "</td>";
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>" . $row ['envelopes'] . "</td>";
	echo "<td>" . $row ['stickers'] . "</td>";
	echo "<td>" . $row ['date_ordered'] . "</td>";
	echo "<td>" . $row ['cost'] . "</td>";
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