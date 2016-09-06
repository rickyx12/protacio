<?php
include("../../../myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];


$ro = new database2();
echo "<br>";
echo "<center><font size=5>".$ro->selectNow("inventory","description","inventoryCode",$inventoryCode)."</font></center>";
echo "<center>Beginning QTY ".$ro->selectNow("inventory","encodedQTY","inventoryCode",$inventoryCode)."</center>";
echo "<center>Remaining QTY ".$ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)."</center>";

$date1 = date("Y")."-01-01";
$date2 = date("Y")."-12-31";

$ro->dispensedMonitor($inventoryCode,$date1,$date2);

echo "<br><br>";


//$ro->getRequestedDept($inventoryCode,$date1,$date2);



?>
