<?php
include("../../myDatabase3.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];
$ro = new database3();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

echo "Adjustment";
echo "<Br>";
echo "From $date to $date1";
echo "<br>";
$ro->inventoryAdjustmentReport($date,$date1);

?>
