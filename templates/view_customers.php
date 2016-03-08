<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Customers </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table-hover ' border='1' style='text-align:left; background-color:skyblue; color:black; margin:0px'>";
echo "<thead style='background-color:cyan'>";
echo "<tr>
<th>Name:   </th>
<th>Mobile:   </th>
<th>Email:   </th>
<th>Address:   </th>
<th>Date Registered:   </th>
<th>Balance:   </th>
<th>PO Number:   </th>
<th>Password:   </th>
</tr>";

echo "</thead>";
foreach ($this->model->allCustomers as $row){
	echo "<td>" . $row ['username'] . "</td>";
	echo "<td>" . $row ['cmobile'] . "</td>";
	echo "<td>" . $row ['cemail'] . "</td>";
	echo "<td>" . $row ['caddr'] . "</td>";
	echo "<td>" . $row ['date_joined'] . "</td>";
	echo "<td>" . $row ['ac_amount'] . "</td>";
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>". "xxxxx" ."</td>";
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