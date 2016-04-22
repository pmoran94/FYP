<?php

include_once './db/simple_db_manager.php';

echo "<div ><h3>Stamps </h3></div>";
echo "<div style='overflow:auto;height:100%'>";
echo "<table class= 'table' style='text-align:left; color:black; margin:0px'>";
echo "<thead>";
echo "<tr>
<th>QR ID:   </th>
<th>Type: </th>
<th>Status: </th>
<th></th>
<th></th>
</tr>";

echo "</thead>";
foreach ($this->model->getAllQRs as $row){
	echo "<td>" . $row ['qrCodeID'] . "</td>";
	echo "<td>" .$row['type']. "</td>";
	echo "<td>";
	if($row['active']=='yes')echo "Active";
	else echo 'Inactive';
	//extra check would be to display an entry which is invalid/out-of-date
	//as inactive does not necessarily mean that the code is not in use
	echo "</td>";
	echo "<td><button class='btn btn-default' type='button' title='' name='action' value=''><span class='glyphicon glyphicon-th-list'></span></button>";
	echo "&nbsp&nbsp&nbsp<button class='btn btn-danger' type='button' title='' name='action' value=''><span class='glyphicon glyphicon-remove'></span></button></td>";
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