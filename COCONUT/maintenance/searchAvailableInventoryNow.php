<?php
include("../../myDatabase.php");
$show = $_GET['show'];
$description = $_GET['description'];
$branch = $_GET['branch'];
$username = $_GET['username'];
$inventoryType = $_GET['inventoryType'];
$ro = new database();

$ro->getMasterListInventory($show,$description,$inventoryType,$username,$branch);

?>
