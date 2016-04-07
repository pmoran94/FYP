<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Stamps </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>Stamp ID:   </th>
<th>Destination: </th>
<th>Status: </th>
<th></th>
</tr>";

echo "</thead>";
foreach ($this->model->trackStampsForCustomer as $row){
	echo "<td>" . $row ['stampID'] . "</td>";
	echo "<td>" . $row ['destination'] . "</td>";
	echo "<td>";
	if($row['scannedOnDep'] == 'no'){
		echo "Post Still in Local PO";	
	} 
	else if($row['scannedOnDep'] == 'yes' && $row['scannedOnArr'] == 'no'){
		echo "Post In Transit";
	}
	else if($row['scannedOnDep'] == 'yes' && $row['scannedOnArr'] == 'yes'){
		echo "Post Arrived at Destined PO"; 
	}
	echo "</td>";

	echo "<td><button class='btn btn-warning' type='button' title='Delete if Arrived at Destination' name='action' value=''><span class='glyphicon glyphicon-remove'></span></button></td>";
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