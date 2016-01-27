<?php
include("../../myDatabase.php");
$inventoryType = $_GET['inventoryType'];
$username = $_GET['username'];
$branch = $_GET['branch'];
$show = $_GET['show'];
$ro = new database();

$ro->getMasterListInventory($show,"",$inventoryType,$username,$branch);


?>
