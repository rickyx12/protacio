<?php
include("../../../myDatabase2.php");
$inventoryCode = $_POST['inventoryCode'];
$department = $_POST['department'];
$qty = $_POST['qty'];
$description = $_POST['description'];
$date = $_POST['date'];
$time = $_POST['time'];
$username = $_POST['username'];

$ro = new database2();
$newQTY = ( $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) - $qty );
$ro->addConsumed($inventoryCode,$department,$qty,$description,$date,$time,$username);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$newQTY);

?>
