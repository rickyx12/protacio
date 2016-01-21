<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$doctor = $_GET['doctor'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];


$ro = new database();

echo "<center><font size=5><b>".$ro->getReportInformation("hmoSOA_name")."</b></font></centeR>";


$ro->getDoctorPatientReport($username,$doctor,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds);

?>
