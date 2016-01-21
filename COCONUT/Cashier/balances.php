<?php
include("../../myDatabase3.php");
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$shift = $_GET['shift'];

$ro = new database3();

$date1 = $year."-".$month."-".$day;
$date2 = $year1."-".$month1."-".$day1;

echo "<b>From:</b>".$date1;
echo "<br>";
echo "<b>To:</b>".$date2;

$ro->getBalances($date1,$date2,$username,$shift);


?>

