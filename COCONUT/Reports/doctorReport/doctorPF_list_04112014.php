<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$show = $_GET['show'];

$ro = new database();

echo "<center><font size=5>Doctor's PF Listing</font></center>";
echo "<center><font size=3>OPD</font></center>";
echo "<center><font size=3>( $month $day, $year )</font></center>";
echo "<center><font size=3>( $fromTime_hour:$fromTime_minutes:$fromTime_seconds - $toTime_hour:$toTime_minutes:$toTime_seconds )</font></center>";

$ro->getDoctorPFReport("OPD",$username,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$show);

?>
