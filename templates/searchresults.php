<?php

include_once 'templates/html_doctype_and_head.php'; 
include_once 'search_form.php';

echo "<div><h3>Search Results</h3></div>";
echo "<div style='overflow:auto;height:200px;'>";
echo "<table class='table table-hover border='1' style='width:100%; text-align:left; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Name: </th>
<th>Email:   </th>
<th>Mobile:   </th>
<th>Address:   </th>
<th>PO Number:   </th>
<th>Car Reg.:   </th>
<th>Date Joined:</th>
<th>Action:  </th>

</tr>";
echo "</thead>";


foreach ($this->model->searchResults as $row){
	echo "<td>" . $row ['name'] . "</td>";
	echo "<td>" . $row ['cemail'] . "</td>";
	echo "<td>" . $row ['cmobile'] . "</td>";
	echo "<td>" . $row ['caddr'] . "</td>";
	echo "<td>" . $row ['ponumber'] . "</td>";
	echo "<td>" . $row ['carRegistration'] . "</td>";
	echo "<td>" . $row ['date_joined'] . "</td>";
	echo "<td><form method='post' action='index.php'>
		<input type='hidden' name='action' value='deleteCustomer' >
		<input type='hidden' name='cus_id' value'".$row['id']."'>
		<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></td>";
	echo "</tr>";
}

echo "</table>";
echo "</div>";

echo "<form action='index.php' method='post'>";
	echo "<button type='submit' class='btn btn-success'> Go Back </button>";
echo "</form>";





?>

<html>
<head>

<link href ="css/misc.css" rel="stylesheet" type="text/css">

</head>
</html>