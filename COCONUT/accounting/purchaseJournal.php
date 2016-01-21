<?php
include("../../myDatabase3.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database3();

$date = $year.$month.$day;
$date1 = $year1.$month1.$day1;

$datez_m = substr($date,0,4);
$datez_d = substr($date,4,2);
$datez_y = substr($date,6,4);


$datez_m1 = substr($date1,0,4);
$datez_d1 = substr($date1,4,2);
$datez_y1 = substr($date1,6,4);

echo $datez_m."-".$datez_d."-".$datez_y."<Br>";
echo $datez_m1."-".$datez_d1."-".$datez_y1."<Br>";

$ro->accounting_purchaseJournal($date,$date1);


?>
