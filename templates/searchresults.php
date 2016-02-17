<?php

include_once 'templates/html_doctype_and_head.php'; 
include_once 'search_form.php';

echo "<div><h3>Search Results</h3></div>";
echo "<div style='overflow:auto;height:200px;'>";
echo "<table class='table table-striped border='1' style='width:100%; text-align:left; background-color:skyblue; color:black; margin:0px'>";
echo "<thead style='background-color:cyan'>";
echo "<tr>
<th>ID  </th>
<th>Name:   </th>
<th>Description:   </th>
<th>Rating:   </th>
</tr>";
echo "</thead>";


foreach ($this->model->searchResults as $row){
	echo "<td>" . $row ['id'] . "</td>";
	echo "<td>" . $row ['name'] . "</td>";
	echo "<td>" . $row ['description'] . "</td>";
	echo "<td>" . $row ['rating'] . "</td>";
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