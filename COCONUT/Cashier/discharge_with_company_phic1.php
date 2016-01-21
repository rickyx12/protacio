<?php
include("../../myDatabase2.php");

$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$month1 = $_POST['month1'];
$day1 = $_POST['day1'];
$year1 = $_POST['year1'];
$type = $_POST['type'];

$ro = new database2();

$date1 = $year."-".$month."-".$day;
$date2 = $year1."-".$month1."-".$day1;

echo "<Center><br><Br><font size=4>Discharged with $type</font><Br><font size=2>($date1 to $date2)</font>";

$ro->dischargeWithCompanyAndPHIC($date1,$date2,$type);

?>
