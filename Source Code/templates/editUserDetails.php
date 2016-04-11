<?php

include_once './db/simple_db_manager.php';
echo "<div style='overflow:auto; margin-left:' class='col-lg-8'>";
echo "<div ><h3>User Details </h3></div>";
echo "<table class= 'table table-hover ' border='0' style='width:100%; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Field   </th>
<th>Details   </th>  
</tr>";

echo "</thead>";
foreach ($this->model->userDetails as $row){
	echo "<tr><td>First Name :</td><td><input type='text' style='height:40px;width:100%'name='fname' id='fname' value='". $row ['fname'] . "'/></td></tr>";
	echo "<tr><td>Surname :</td><td><input type='text' style='height:40px;width:100%'name='sname' id='sname' value='". $row ['sname'] ."'/></td></tr>";
	echo "<tr><td>Mobile :</td><td><input type='text' style='height:40px;width:100%'name='mobile' id='mobile' value='"  . $row ['cmobile'] ."'/></td></tr>";
	echo "<tr><td>Email :</td><td>" . $row ['cemail'] . "</td><td><p style='color:red'>This information cannot be changed here.</p></td></tr>";
	echo "<tr><td>PONumber :</td><td>" . $row ['ponumber'] . "</td><td><p style='color:red'>This information cannot be changed!.</p></td></tr>";
	echo "<tr><td>Car Registration :</td><td><input type='text' style='height:40px;width:100%'name='mobile' id='mobile' value='"  . $row ['carRegistration'] ."'/></td><td><button type='button' style='height:100%:width:100%' class='btn-warning'>Update Info</button></td></tr>";
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