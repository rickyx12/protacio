<?php
include("../../../myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];


$ro = new database2();
echo "<br>";
echo "<center><font size=5>".$ro->selectNow("inventory","description","inventoryCode",$inventoryCode)."</font></center>";
echo "<center>Beginning QTY ".$ro->selectNow("inventory","encodedQTY","inventoryCode",$inventoryCode)."</center>";
echo "<center>Remaining QTY ".$ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)."</center>";

$ro->dispensedMonitor($inventoryCode,$month,$day,$year,$month1,$day1,$year1);

echo "<br><br>";

$ro->getRequestedDept($inventoryCode,$year."-".$month."-".$day,$year1."-".$month1."-".$day1);



?>
