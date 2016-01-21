<?php
include("../../../myDatabase.php");

$fromDate_month = $_GET['fromDate_month'];
$fromDate_day = $_GET['fromDate_day'];
$fromDate_year = $_GET['fromDate_year'];
$toDate_month = $_GET['toDate_month'];
$toDate_day = $_GET['toDate_day'];
$toDate_year = $_GET['toDate_year'];
$show = $_GET['show'];

$ro = new database();

echo "<center>";
echo "<font size=5>Doctor's PF (IPD)</font>";
echo "<br><font size=2>(".$fromDate_month." ".$fromDate_day.", ".$fromDate_year." - ".$toDate_month." ".$toDate_day.", ".$toDate_year." )</font><br>";
$ro->doctorPF_ipd($fromDate_month,$fromDate_day,$fromDate_year,$toDate_month,$toDate_day,$toDate_year,$show);


?>
