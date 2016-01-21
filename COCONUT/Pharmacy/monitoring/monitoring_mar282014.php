<?php
include("../../../myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];

$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];


$ro = new database2();
echo "<br>";
echo "<center><font size=5>".$ro->selectNow("inventory","description","inventoryCode",$inventoryCode)."</font></center>";
echo "<center>$month $day, $year</center>";
echo "<Center>( ".$fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds." - ".$toTime_hour.":".$toTime_minutes.":".$toTime_seconds.")</center>";
$ro->dispensedMonitor($inventoryCode,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds);

?>
