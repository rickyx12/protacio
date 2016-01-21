<?php
include("../../myDatabase.php");
$branch = $_GET['branch'];
$floor = $_GET['floor'];
$ro = new database();

$ro->showAllRoom($branch,"","NURSING",$floor);
?>
