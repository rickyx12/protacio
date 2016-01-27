<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$ro = new database2();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;




?>
