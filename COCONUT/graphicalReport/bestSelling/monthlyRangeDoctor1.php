<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database2();

$date1 = $year."-".$month."-".$day;
$date2 = $year1."-".$month1."-".$day1;

echo "<center><br><font size=3>Top 5 Doctors</font><br>";
echo "<font size=2> ($date1 to $date2) </font>";


$ro->getTopDoctors($date1,$date2,"ATTENDING");

?>
