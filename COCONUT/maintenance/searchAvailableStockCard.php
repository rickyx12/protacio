<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$ro = new database();

$ro->getMasterListStockCard($description);

?>
