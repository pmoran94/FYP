<?php

include_once './db/simple_db_manager.php';
echo "<div class='col-lg-2'>";
echo "</div>";
echo "<div style='overflow:auto; margin-left:' class='col-lg-8'>";
echo "<div ><h3>User Details </h3></div>";
echo "<table class= 'table table-hover ' border='0' style='width:100%; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Field   </th>
<th>Details   </th>  
</tr>";

echo "</thead>";
foreach ($this->model->employeeDetails as $row){
	echo "<tr><td>First Name :</td><td>" . $row ['fname'] . "</td></tr>";
	echo "<tr><td>Surname :</td><td>". $row ['sname'] ."</td></tr>";
	echo "<tr><td>D.O.B. :</td><td>" . $row ['dob'] . "</td></tr>";
	echo "<tr><td>Email :</td><td>" . $row ['email'] . "</td></tr>";
	echo "<tr><td>Mobile :</td><td>" . $row ['mobile'] . "</td></tr>";
	echo "<tr><td>Address :</td><td>" . $row ['address'] . "</td></tr>";
	echo "<tr><td>Emp. No. :</td><td>" . $row ['emp_no'] . "</td></tr>";
	echo "<tr><td>Date Employed :</td><td>" . $row['date_employed'] . "</td></tr>";
	echo "<tr><td>Is Admin? :</td><td>" . $row ['is_admin'] . "</td></tr>";
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