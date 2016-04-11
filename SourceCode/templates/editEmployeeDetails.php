<?php

include_once './db/simple_db_manager.php';
echo "<div style='overflow:auto;'>";
echo "<div ><h3>Edit Details </h3></div>";
echo "<table class= 'table  ' border='0' style='width:100%; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Field   </th>
<th>Details   </th>  
</tr>";

echo "</thead>";
foreach ($this->model->employeeDetails as $row){
	echo "<tr><td>First Name :</td><td><input type='text' style='height:35px;width:100%'name='fname' id='fname' value='". $row ['fname'] . "'/></td></tr>";
	echo "<tr><td>Surname :</td><td><input type='text' style='height:35px;width:100%'name='sname' id='sname' value='". $row ['sname'] ."'/></td></tr>";
	echo "<tr><td>Mobile :</td><td><input type='text' style='height:35px;width:100%'name='mobile' id='mobile' value='"  . $row ['mobile'] ."'/></td></tr>";
	echo "<tr><td>Address :</td><td><input type='text' style='height:35px;width:100%'name='address' id='address' value='"  . $row ['address'] ."'/></td></tr>";
	echo "<tr><td>Email :</td><td>" . $row ['email'] . "</td><td><p style='color:red'>This information cannot be changed here.</p></td></tr>";
	echo "<tr><td>Employee No. :</td><td>" . $row ['emp_no'] . "</td><td><p style='color:red'>This information cannot be changed!.</p></td></tr>";
	echo "<tr><td>Is Admin :</td><td>" . $row ['is_admin'] ."</td><td><p style='color:red'>Only an Admin can change this information.</p></tr>";
	echo "<tr><td><button type='button' style='height:100%:width:100%' class='btn-warning'>Update Info</button></td></tr>";
}

//echo "<tr><td></td><td></td></td>";
echo "</table>";
echo "</div>";

?>

<html>
<head>

<link href ="css/misc.css" rel="stylesheet" type="text/css">
</head>
</html>