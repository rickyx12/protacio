<?php
include("../../myDatabase.php");
$itemNo = $_GET['itemNo'];
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
$username = $_GET['username'];
$branch = $_GET['branch'];


$ro = new database();
$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus","doneBy_".$doctor);
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus_time",date("H:i:s"));

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/doctorPatient_update.php?module=DOCTOR&username=$username&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&branch=$branch&doctor=$doctor'
</script>";

?>
