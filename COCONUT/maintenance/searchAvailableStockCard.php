<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$username = $_GET['username'];
$ro = new database();

$ro->getMasterListStockCard($description,$username);

?>
