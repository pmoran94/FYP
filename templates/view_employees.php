<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Employees</h3></div>";
echo "<div style='overflow:auto;height:200px'>";
echo "<table class= 'table table-hover ' border='1' style='text-align:left; background-color:skyblue; color:black; margin:0px'>";
echo "<thead style='background-color:cyan'>";
echo "<tr>
<th>ID  </th>
<th>Name:   </th>
<th>Is Admin:   </th>
<th>DoB:   </th>
<th>Mobile:   </th>
<th>Email:   </th>
<th>Address:   </th>
<th>Employee No.:   </th>
<th>Date Started:   </th>
</tr>";

echo "</thead>";
foreach ($this->model->allEmployees as $row){
	echo "<tr>";
	echo "<td>" . $row ['e_id'] . "</td>";
	echo "<td>" . $row ['username'] . "</td>";
	echo "<td>" . $row ['is_admin'] . "</td>";
	echo "<td>" . $row ['dob'] . "</td>";
	echo "<td>" . $row ['mobile'] . "</td>";
	echo "<td>" . $row ['address'] . "</td>";
	echo "<td>" . $row ['email'] . "</td>";
	echo "<td>" . $row ['emp_no'] . "</td>";
	echo "<td>" . $row ['date_started'] . "</td>";

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