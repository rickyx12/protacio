<?php
include("../../../myDatabase2.php");
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$month1 = $_POST['month1'];
$day1 = $_POST['day1'];
$year1 = $_POST['year1'];
$roomType = $_POST['roomType'];

$ro = new database2();

$date1 = $year."-".$month."-".$day;
$date2 = $year1."-".$month1."-".$day1;

echo "<center><br><br><font size=4>$roomType</font><br><font size=3>($date1 to $date2)</font>";
$ro->segregatedRoom($date1,$date2,$roomType);

?>
