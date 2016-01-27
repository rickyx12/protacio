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

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/billing/transactionSummary.php");
//$ro->transactionSummaryDischarge($date,$date1);
echo "<Br>From $date to $date1<bR>";
$ro->coconutHidden("month",$month);
$ro->coconutHidden("day",$day);
$ro->coconutHidden("year",$year);
$ro->coconutHidden("month1",$month1);
$ro->coconutHidden("day1",$day1);
$ro->coconutHidden("year1",$year1);
$ro->coconutButton("Proceed");
$ro->coconutFormStop();

?>
