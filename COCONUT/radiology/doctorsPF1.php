<?php
include("../../myDatabase2.php");

$doctors = $_GET['doctors'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];

$ro = new database2();

$date = $fromYear."-".$fromMonth."-".$fromDay;
$date1 = $toYear."-".$toMonth."-".$toDay;
$ro->radiologyPF($date,$date1,$doctors);

?>
