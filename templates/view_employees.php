<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Employees</h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Name:   </th>
<th>Is Admin:   </th>
<th>DoB:   </th>
<th>Mobile:   </th>
<th>Address:   </th>
<th>Email:   </th>
<th>Employee No.:   </th>
<th>Date Started:   </th>
<th colspan='2'>Action:  </th>
</tr>";

echo "</thead>";
foreach ($this->model->allEmployees as $row){
	echo "<tr>";
	echo "<td>" . $row ['username'] . "</td>";
	echo "<td>" . $row ['is_admin'] . "</td>";
	echo "<td>" . $row ['dob'] . "</td>";
	echo "<td>" . $row ['mobile'] . "</td>";
	echo "<td>" . $row ['address'] . "</td>";
	echo "<td>" . $row ['email'] . "</td>";
	echo "<td>" . $row ['emp_no'] . "</td>";
	echo "<td>" . $row ['date_employed'] . "</td>";
	echo "<td><a><span class='glyphicon glyphicon-briefcase'></span></a></td><td><a><span class='glyphicon glyphicon-remove'></span></a></td>"; 

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