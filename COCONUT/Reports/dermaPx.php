<?php
include("../../myDatabase3.php");
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];

$ro = new database3();

$date = $fromYear."-".$fromMonth."-".$fromDay;
$date1 = $toYear."-".$toMonth."-".$toDay;

$ro->getDermaPx($date,$date1);

?>
