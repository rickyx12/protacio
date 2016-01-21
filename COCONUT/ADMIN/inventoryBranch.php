<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$branch = $_GET['branch'];
$inventoryType = $_GET['inventoryType'];
$show = $_GET['show'];

$ro = new database();


$ro->getMasterListInventory($show,"",$inventoryType,$username,$branch);


?>
