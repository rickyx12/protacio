<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$shift = $_GET['shift'];
$ro = new database3();

$month = date("m");
$day = date("d");
$year = date("Y");
$fromTime_hour = date("H");
$fromTime_minutes = date("i");
$fromTime_seconds = date("s");
$toTime_hour = date("H");
$toTime_minutes = date("i");
$toTime_seconds = date("s");



$ro->getPatientChargesUnpaid($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$registrationNo,$shift,"BALANCE")


?>
