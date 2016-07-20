<?php
include("../../myDatabase.php");
include "../../myDatabase4.php";
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$username = $_GET['username'];


$ro = new database();
$ro4 = new database4();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

$dates = $ro4->formatDate($date);
$dates1 = $ro4->formatDate($date1);
echo "Near Expiry<Br>";
echo $dates." - ".$dates1;

$ro->expiration($month,$day,$year,$month1,$day1,$year1,$username);

?>
