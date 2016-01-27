<?php
include("../../myDatabase3.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database3();

$datez = $year."-".$month."-".$day;
$datez1 = $year1."-".$month1."-".$day1;

echo $datez."<br>".$datez1;

$ro->expenses_dashboard($datez,$datez1);

?>
